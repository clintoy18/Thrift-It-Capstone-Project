<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LandingService;

class LandingPageController extends Controller
{
    protected $landingService;

    public function __construct(LandingService $landingService)
    {
        $this->landingService = $landingService;
    }

    public function index()
    {
       $data =  $this->landingService->getLandingData();
       $products = $data['products'];
       $categories = $data['categories'];
       
       return view('landing.index', compact('products','categories'));
    }
}
