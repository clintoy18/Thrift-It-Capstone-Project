<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LandingService;
use App\Models\Product;
use App\Models\Donation;
use App\Models\Segment;

class LandingPageController extends Controller
{
    protected $landingService;

    public function __construct(LandingService $landingService)
    {
        $this->landingService = $landingService;
    }

    public function index()
    { 
        $products = Product::with(['category', 'user'])->where('status','available')->get();
        $donations = Donation::with(['user', 'category'])->where('status', 'available')->get();
        $segments = Segment::all();
        return view('dashboard', compact('products','donations','segments'));
    }
}
