<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    
    public function index(Request $request)
    {
        $query = $request->input('query');
        $products = $query ? Product::search($query)->get() : collect(); // Fetch only if there's a search
        return view('search', compact('products', 'query'));
    }

}
