<?php

namespace App\Http\Controllers;

use App\Models\Segment;
use App\Services\ProductService;

class SegmentController extends Controller
{


    protected $productService;
    
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function show(Segment $segment)
    {
        $products = $this->productService->getApprovedProductsBySegment($segment);

        return view('segments.show', compact('segment', 'products'));
    }
}
