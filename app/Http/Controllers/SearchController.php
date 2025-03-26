<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('qeury');

        $products = $query ? Product::search($query)->get() : collect(); // Only fetch if query exists

        return view('search', compact('products','query'));
    }
}
