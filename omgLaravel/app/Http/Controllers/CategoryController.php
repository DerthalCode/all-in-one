<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Company;

class CategoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except' => ['showCompanies']]);
    }

    public function showAddCategory() {
        return view('pages.add-category');
    }

    public function showCompanies(Request $request) {
        $categories = Category::all();
        
        $companies = [];
        if(request('category')) {
            $companies = Company::where('category_id', request('category'))->get();
        }

        return view('pages.show-categories', compact('categories', 'companies'));
    }

    public function create(Request $request) {
        $validated = $request->validate([
            'category' => 'required|between:2,50|regex:/^[\pL\s\-]+$/u'
        ]);
        
        Category::create([
            'category' => $request->category
        ]);

        return back()->with('success', 'Sekmingai ivesta kategorija');
    }
}
