<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Goods;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showDashboard() {
        $companies = Company::where('user_id', Auth::id())->get();
        $orders = Orders::where('user_id', Auth::id())->get();
        $categories = Category::all();

        return view('pages.dashboard', compact('orders', 'companies', 'categories'));
    }

    public function takeOrder(Goods $goods) {
        
        Orders::create([
            'user_id' => Auth::id(),
            'goods_id' => $goods->id
        ]);

        return back()->with('success', "$goods->name sekmingai uzsakyta");
    }
}
