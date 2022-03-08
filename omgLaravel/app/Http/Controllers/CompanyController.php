<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CompaniesImport;
use App\Models\Category;
use App\Models\CsvData;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\CompaniesResource;

class CompanyController extends Controller {

    public function __construct() {
        $this->middleware('auth', ['except' => ['index', 'showCompany', 'companies', 'company']]);
    }

    public function index(Request $request) {
        $validated = $request->validate([
            'code' => 'digits_between:4,9|nullable'
        ]);

        $companyNames = Company::pluck('name')->toArray();

        if( $request->input() ){
            $companies = Company::when($request->code, function($query, $code){
                return $query->where('code', $code);
            })->when($request->name, function($query, $name){
                return $query->where('name', $name);
            })->when($request->date, function($query, $date){
                return $query->orderBy('created_at', $date);
            })->paginate(5);
        } else {
            $companies = Company::whereDate('created_at', Carbon::today()->toDateString())->paginate(5);
        }

        return view('pages.home', compact('companies', 'companyNames'));
    }

    public function addCompany() {
        $categories = Category::all();
        return view('pages.add-company', compact('categories'));
    }

    public function storeCompany(Request $request) {
        $validated = $request->validate([
            'name' => 'required|unique:companies|max:255',
            'code'=>'required',
            'logo' => 'image|mimes:jpeg,jpg,png,gif|max:10000',
            'category' => 'required'
        ]);

        $filename = "";
        if(request()->hasFile('logo')) {
            $path = $request->file('logo')->store('public/images');
            $filename = str_replace('public/', '', $path);
        }
        
        Company::create([
            'name' => request('name'),
            'code' => request('code'),
            'vat' => request('vat'),
            'address' => request('address'),
            'head' => request('head'),
            'description' => request('description'),
            'logo' => $filename ? 'storage/'.$filename : '',
            'user_id' => Auth::id(),
            'category_id' => request('category')
        ]);

        return redirect('/');
    }

    public function showCompany(Company $company) {
        return view('pages.show-company', compact('company'));
    }

    public function deleteCompany(Company $company) {
        if(Gate::denies('delete-company', $company)) {
            return back()->withErrors(['errors' => 'Neturi teisiu istrinti irasa']);
        }
        $company->delete();
        return redirect('/');
    }

    public function updateCompany(Company $company) {
        if(Gate::denies('edit-company', $company)) {
            return back()->withErrors(['erorrs' => 'Neturi teisiu keisti irasa']);
        }
        return view('pages.edit-company', compact('company'));
    }

    public function storeUpdate(Company $company, Request $request) {
        if($request->hasFile('logo')){
            File::delete(storage_path('app/public/'.$company->logo));
            $path = $request->file('logo')->store('public/images');
            $filename = str_replace('public/', '', $path);
            Company::where('id', $company->id)->update(['logo'=>$filename]);
        }
        Company::where('id', $company->id)->update($request->only(['name', 'code', 'vat', 'address', 'head', 'description']));
        return redirect('/company/'.$company->id)->with('success', 'Imone pakeista sekmigai');
    }

    public function importCompanies() {
        return view("pages.import-companies");
    }

    public function parseCompaniesImport(Request $request) {
        $validated = $request->validate([
            'companies_csv' => 'required|file|mimes:csv'
        ]);

        $companies_csv = $request->file('companies_csv');
        $companies = Excel::toArray(new CompaniesImport, $companies_csv)[0];

        if(count($companies) > 0) {
            $csvDataFile = CsvData::create([
                'csv_filename' => $companies_csv->getClientOriginalName(),
                'csv_data' => json_encode($companies)
            ]);
        } else {
            redirect()->back();
        }

        return view("pages.import-table", [
            'companies' => $companies,
            'fileId' => $csvDataFile->id
        ]);
    }

    public function storeCompaniesImport(Request $request) {
        $tableRow = CsvData::find($request->importCompanies);
        $companies = json_decode($tableRow->csv_data, true);

        foreach($companies as $row) {
            Company::create([
                "name" => $row[0],
                'category_id' => Category::where('category', $row[1])->pluck('id')[0],
                "code" => $row[2],
                'vat' => $row[3],
                'address' => $row[4].' ,'.$row[5],
                'head' => $row[6],
                'description' => $row[7],
                'logo' => $row[8],
                'user_id' => Auth::id()
            ]);
        }

        return redirect('/')->with('success', 'Imones importuotos sekmingai');
    }

    public function showCatalogs() {
        $companies = Company::all();
        return view('pages.company-catalogs', compact('companies'));
    }

    public function updateCategory(Request $request, Company $company) {
        $company->category_id = $request->category;
        $company->save();

        return back()->with('success', "$company->name kategorija pakeista i {$company->category->category}");
    }

}
