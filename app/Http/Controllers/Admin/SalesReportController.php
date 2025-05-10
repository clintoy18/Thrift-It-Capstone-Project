<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;

class SalesReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('rolemiddleware:admin');
    }

    public function generateMonthlyReport($month)
    {
        $monthName = Carbon::create()->month((int)$month)->format('F');
        $year = Carbon::now()->year;

        $products = Product::with(['user', 'category'])
            ->where('status', 'sold')
            ->whereMonth('created_at', (int)$month)
            ->whereYear('created_at', $year)
            ->get();

        $totalSales = $products->sum('price');
        $totalProducts = $products->count();

        $html = View::make('admin.reports.monthly-sales', [
            'products' => $products,
            'monthName' => $monthName,
            'year' => $year,
            'totalSales' => $totalSales,
            'totalProducts' => $totalProducts
        ])->render();

        return Response::make($html, 200, [
            'Content-Type' => 'text/html',
            'Content-Disposition' => "inline; filename=sales-report-{$monthName}-{$year}.html"
        ]);
    }

    public function generateYearlyReport()
    {
        $year = Carbon::now()->year;
        $monthlyData = [];

        for ($month = 1; $month <= 12; $month++) {
            $products = Product::with(['user', 'category'])
                ->where('status', 'sold')
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->get();

            $monthlyData[$month] = [
                'month' => Carbon::create()->month($month)->format('F'),
                'products' => $products,
                'totalSales' => $products->sum('price'),
                'totalProducts' => $products->count()
            ];
        }

        $html = View::make('admin.reports.yearly-sales', [
            'monthlyData' => $monthlyData,
            'year' => $year
        ])->render();

        return Response::make($html, 200, [
            'Content-Type' => 'text/html',
            'Content-Disposition' => "inline; filename=sales-report-{$year}.html"
        ]);
    }
} 