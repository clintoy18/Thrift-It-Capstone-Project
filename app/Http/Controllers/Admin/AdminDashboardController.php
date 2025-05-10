<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Report;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('rolemiddleware:admin');
    }

    public function index(): View
    {
        // Get statistics
        $stats = [
            'total_users' => User::count(),
            'total_products' => Product::count(),
            'total_products_sold' => Product::where('status', 'sold')->count(),
            'pending_reports' => Report::where('status', 'pending')->count(),
            'active_listings' => Product::where('status', 'active')->count(),
            'new_users_today' => User::whereDate('created_at', today())->count(),
            'new_products_today' => Product::whereDate('created_at', today())->count(),
        ];

        // Get recent reports
        $recentReports = Report::with(['reporter', 'reportedUser'])
            ->latest()
            ->take(5)
            ->get();

        // Get recent products
        $recentProducts = Product::with(['user', 'category'])
            ->latest()
            ->take(5)
            ->get();

        // Monthly sales data for visualization
        $salesMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $salesData = [];

        // Get detailed monthly sales data
        $monthlySalesDetails = [];
        foreach (range(1, 12) as $month) {
            $monthlyProducts = Product::with(['user', 'category'])
                ->where('status', 'sold')
                ->whereMonth('created_at', $month)
                ->get();

            $monthlyTotal = $monthlyProducts->sum('price');
            $salesData[] = $monthlyTotal;

            $monthlySalesDetails[$month] = [
                'total_sales' => $monthlyTotal,
                'total_products' => $monthlyProducts->count(),
                'products' => $monthlyProducts,
                'month_name' => $salesMonths[$month - 1]
            ];
        }

        // Get yearly sales summary
        $yearlySalesSummary = Product::where('status', 'sold')
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total_products'),
                DB::raw('SUM(price) as total_sales')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Report categories breakdown
        $reportCategories = ['Spam', 'Inappropriate Content', 'Scam', 'Harassment', 'Other'];
        $reportCounts = [
            Report::where('reason', 'Spam')->count(),
            Report::where('reason', 'Inappropriate Content')->count(),
            Report::where('reason', 'Scam')->count(),
            Report::where('reason', 'Harassment')->count(),
            Report::where('reason', 'Other')->count(),
        ];

        // Report status breakdown
        $statusCounts = [
            'pending' => Report::where('status', 'pending')->count(),
            'resolved' => Report::where('status', 'resolved')->count(),
            'rejected' => Report::where('status', 'rejected')->count(),
        ];

        return view('admin.dashboard', compact(
            'stats',
            'recentReports',
            'recentProducts',
            'salesMonths',
            'salesData',
            'reportCategories',
            'reportCounts',
            'statusCounts',
            'monthlySalesDetails',
            'yearlySalesSummary'
        ));
    }
}
