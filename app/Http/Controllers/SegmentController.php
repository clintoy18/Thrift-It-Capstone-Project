<?php

namespace App\Http\Controllers;

use App\Models\Segment;
use Illuminate\Http\Request;

class SegmentController extends Controller
{
    /**
     * Display the specified segment.
     */
    public function show(Segment $segment)
    {
        // Only fetch approved products for the segment
        $products = $segment->products()
            ->where('approval_status', 'approved')
            ->with(['category'])
            ->get();

        return view('segments.show', compact('segment', 'products'));
    }
}
