<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categories;

class LandingPageController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'available')->latest()->take(12)->get();
        $categories = Categories::all();
        return view('landing.index', compact('products', 'categories'));
    }
}
