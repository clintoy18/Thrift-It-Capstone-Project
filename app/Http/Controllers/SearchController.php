<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the search request and return results with pagination.
     */
    public function index(Request $request)
    {
        // Validate the search query
        $request->validate([
            'query' => 'nullable|string|max:255', // Ensure the query is a valid string with max length
        ]);

        // Retrieve the search query from the request
        $query = $request->input('query');

        // If query exists, search products; otherwise, return an empty collection
        $products = $query
            ? Product::where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")  // You can also search in other fields like description
                ->paginate(10)  // Paginate the results (10 results per page)
            : collect();  // No products if no query is provided

        return view('search', compact('products', 'query'));
    }
}
