<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    public function index(): View
    {
        $reports = Report::with(['reporter', 'reportedUser'])
            ->latest()
            ->paginate(10);

        return view('admin.reports.index', compact('reports'));
    }

    public function show(Report $report): View
    {
        $report->load(['reporter', 'reportedUser']);
        return view('admin.reports.show', compact('report'));
    }

    public function update(Request $request, Report $report): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,resolved,rejected',
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        $report->update($validated);

        return redirect()->route('admin.reports.show', $report)
            ->with('success', 'Report status updated successfully.');
    }

    public function destroy(Report $report): RedirectResponse
    {
        $report->delete();

        return redirect()->route('admin.reports.index')
            ->with('success', 'Report deleted successfully.');
    }
} 