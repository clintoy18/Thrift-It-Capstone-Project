<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Donation;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use App\Models\Segment;

class UserDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'user'])
            ->where(function ($query) {
                $query->where('status', 'available')
                    ->orWhere('approval_status', 'approved');
            })
            ->whereHas('user', function ($query) {
                // Only include users who have an active subscription
                $query->whereHas('subscriptions', function ($subQuery) {
                    $subQuery->whereNull('ends_at'); // Active subscription
                });
            })
            ->paginate(10);

        $donations = Donation::with(['user', 'category'])->where('status', 'available')->get();
        $segments = Segment::all();
        return view('dashboard', compact('products', 'donations', 'segments'));
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
