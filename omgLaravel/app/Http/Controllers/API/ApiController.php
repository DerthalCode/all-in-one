<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Resources\CompaniesResource;
use App\Models\Company;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\CompanyUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Validator;


class ApiController extends Controller
{
    public function companies() {
        return CompaniesResource::collection(Company::paginate(2));
    }

    public function company(Company $company) {
        return new CompaniesResource($company);
    }

    public function addCompany(CompanyRequest $request) {
        $validated = $request->validated();
       
        Company::create([
            'name' => request('name'),
            'code' => request('code'),
            'vat' => request('vat'),
            'address' => request('address'),
            'head' => request('head'),
            'description' => request('description'),
            'logo' => "",
            'user_id' => Auth::id(),
            'category_id' => request('category_id')
        ]);

        return response()->json(['success' => 'Imone sukurta sekmingai']);
    }

    public function myCompanies() {
        return CompaniesResource::collection(Company::where('user_id', Auth::id())->paginate(10));
    }

    public function updateMyCompany(CompanyUpdateRequest $request, Company $company) {
        $validated = $request->validated();

        $company->update($request->only(['name', 'code', 'vat', 'logo', 'address', 'head', "description"]));

        return response()->json(['success' => "Sekmingai atnaujinta imone \"$company->name\""]);
    }

    public function deleteMyCompany(Company $company) {
        $name = $company->name;
        $company->delete();

        return response()->json(['success' => "sekmingai istrinta imone \"$name\""]);
    }
}
