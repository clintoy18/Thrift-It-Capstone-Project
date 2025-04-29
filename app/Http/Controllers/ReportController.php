<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use App\Http\Requests\StoreReportsRequest;
use App\Http\Requests\IndexReportsRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexReportsRequest $request): View
    {
        $query = Report::with(['reporter', 'reportedUser'])
            ->where('reporter_id', Auth::id());

        if ($request->filled('search')) {
            $search = $request->validated('search');
            $query->whereHas('reportedUser', function ($q) use ($search) {
                $q->where('fname', 'like', "%{$search}%")
                  ->orWhere('lname', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->validated('status'));
        }

        $reports = $query->latest()->paginate(10);

        return view('reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user): View
    {
        if ($user->id === Auth::id()) {
            abort(403, 'You cannot report yourself.');
        }

        return view('reports.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReportsRequest $request, User $user): RedirectResponse
    {
        if (Auth::id() === $user->id) {
            return redirect()
                ->back()
                ->with('error', 'You cannot report yourself.');
        }

        $existingReport = Report::where('reporter_id', Auth::id())
            ->where('reported_user_id', $user->id)
            ->where('status', 'pending')
            ->first();

        if ($existingReport) {
            return redirect()
                ->back()
                ->with('error', 'You have already submitted a pending report for this user.');
        }

        $validated = $request->validated();
        $validated['reporter_id'] = Auth::id();
        $validated['reported_user_id'] = $user->id;
        $validated['status'] = 'pending';

        Report::create($validated);

        return redirect()
            ->route('reports.index')
            ->with('success', 'Report submitted successfully. Our team will review it shortly.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report): View
    {
        if ($report->reporter_id !== Auth::id() && Auth::user()->role !== 2) {
            abort(403);
        }

        $report->load(['reporter', 'reportedUser']);

        return view('reports.show', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        if (Auth::user()->role !== 2) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,reviewed,resolved',
            'admin_notes' => 'nullable|string',
        ]);

        DB::transaction(function () use ($report, $validated) {
            $report->update($validated);

            // If report is resolved, disable the reported user's account
            if ($validated['status'] === 'resolved') {
                $reportedUser = User::find($report->reported_user_id);
                if ($reportedUser) {
                    Log::info('Disabling user account', [
                        'user_id' => $reportedUser->id,
                        'report_id' => $report->id
                    ]);
                    
                    $result = $reportedUser->update(['is_active' => false]);
                    
                    Log::info('User account disabled result', [
                        'success' => $result,
                        'user_id' => $reportedUser->id
                    ]);
                }
            }
        });

        return redirect()->route('reports.show', $report)
            ->with('success', 'Report updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report): RedirectResponse
    {
        if ($report->reporter_id !== Auth::id() && Auth::user()->role !== 2) {
            abort(403);
        }

        $report->delete();

        return redirect()
            ->route('reports.index')
            ->with('success', 'Report deleted successfully.');
    }
} 