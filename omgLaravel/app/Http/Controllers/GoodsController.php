<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Goods;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    public function showCatalog(Company $company) {
        $companyName = $company->name;
        $goods = Goods::where('company_id', $company->id)->get();
        
        return view('pages.goods-catalog', compact('companyName', 'goods'));
    }
}
