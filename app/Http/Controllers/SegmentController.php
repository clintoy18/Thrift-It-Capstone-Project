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

        // Use different views based on segment name (more flexible)
        $viewName = match(strtolower($segment->name)) {
            'women' => 'segments.show1',
            'men' => 'segments.show',
            'kids' => 'segments.show2',
            default => 'segments.show'
        };

        return view($viewName, compact('segment', 'products'));
    }
}
