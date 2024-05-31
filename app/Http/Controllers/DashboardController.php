<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $bestSellers = Product::where('status_bs', true)->get();
        $products = Product::all();
        return view('dashboard', compact('bestSellers', 'products'));
    }


}
