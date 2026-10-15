<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'asc')->get();

        $products = Product::with(['category', 'variants'])
            ->where('status', 'available')
            ->orderBy('id', 'asc')
            ->get();

        return view('home', compact('categories', 'products'));
    }
}