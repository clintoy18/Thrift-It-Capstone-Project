<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LandingService;
use App\Models\Product;
use App\Models\Donation;
use App\Models\Segment;
use App\Models\Categories;
use App\Models\Barangay;

class LandingPageController extends Controller
{
    protected $landingService;

    public function __construct(LandingService $landingService)
    {
        $this->landingService = $landingService;
    }

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
}
