<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Donation;
use App\Models\Categories;
use App\Models\Barangay;
use Illuminate\Support\Facades\Auth;
use App\Models\Segment;

class UserDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $selectedCategoryId = $request->query('category');
        $selectedBarangayId = $request->query('barangay');
        
        $query = Product::with(['category', 'user', 'barangay'])
            ->where(function ($query) {
                $query->where('status', 'available')
                    ->orWhere('approval_status', 'approved');
            })
            ->whereHas('user', function ($query) {
                // Only include users who have an active subscription
                $query->whereHas('subscriptions', function ($subQuery) {
                    $subQuery->whereNull('ends_at'); // Active subscription
                });
            });

        if ($selectedCategoryId) {
            $query->where('category_id', $selectedCategoryId);
        }

        if ($selectedBarangayId) {
            $query->where('barangay_id', $selectedBarangayId);
        }

        $products = $query->paginate(10);

        $donations = Donation::with(['user', 'category'])->where('status', 'available')->get();
        $segments = Segment::all();
        $categories = Categories::all();
        $barangays = Barangay::all();
        
        return view('dashboard', compact('products', 'donations', 'segments', 'categories', 'barangays', 'selectedCategoryId', 'selectedBarangayId'));
    }

    /**
     * Get filtered products for AJAX requests
     */
    public function products(Request $request)
    {
        $selectedCategoryId = $request->query('category');
        $selectedBarangayId = $request->query('barangay');
        
        $query = Product::with(['category', 'user', 'barangay', 'images'])
            ->where(function ($query) {
                $query->where('status', 'available')
                    ->orWhere('approval_status', 'approved');
            })
            ->whereHas('user', function ($query) {
                // Only include users who have an active subscription
                $query->whereHas('subscriptions', function ($subQuery) {
                    $subQuery->whereNull('ends_at'); // Active subscription
                });
            });

        if ($selectedCategoryId) {
            $query->where('category_id', $selectedCategoryId);
        }

        if ($selectedBarangayId) {
            $query->where('barangay_id', $selectedBarangayId);
        }

        $products = $query->paginate(10);
        
        $html = view('dashboard.partials.products-grid', compact('products'))->render();
        return response()->json(['html' => $html]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
