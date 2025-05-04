<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;

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
    
        // Initialize empty collections for products and users
        $products = collect();
        $users = collect();
    
        // If a query exists, search for both users and products
        if ($query) {
            // Search for products by name or description
            $products = Product::where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->paginate(10);  // Paginate the results for products (10 per page)
            
            // Search for users by name or email
            $users = User::where('fname', 'like', "%{$query}%")
                ->orWhere('email', 'like', "%{$query}%")
                ->paginate(10);  // Paginate the results for users (10 per page)
        }
    
        // Return the view with the search results for both users and products
        return view('search', compact('products', 'users', 'query'));
    }
    
}
