<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApprovalStatusDonationUpdateRequest;
use App\Models\Donation;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\DonationService;

class AdminDonationController extends Controller
{

    protected $donationService;
    public function __construct(DonationService $donationService)
    {
        $this->donationService = $donationService;
    }
    public function index(): View
    {
        $approvedDonations = $this->donationService->getDonationsByStatusPaginated('approved');
        $pendingDonations = $this->donationService->getDonationsByStatusPaginated('pending');

        return view('admin.donations.index', compact('approvedDonations', 'pendingDonations'));
    }

    public function show(Donation $donation): View
    {
        $donation->load(['user', 'category', 'comments.user']);
        return view('admin.donations.show', compact('donation'));
    }
    

    public function update(ApprovalStatusDonationUpdateRequest $request, Donation $donation): RedirectResponse
    {
        $validated = $request->validated();
        $donation->update($validated);

        return redirect()->route('admin.donations.index')
            ->with('success', 'Donation approval status updated successfully.');
    }
    
    public function edit(Donation $donation): View
    {
        $donation->load(['user', 'category']);
        return view('admin.donation.edit', compact('donation'));
    }


    public function destroy(Donation $donation): RedirectResponse
    {
        $donation->delete();

        return redirect()->route('admin.donations.index')
            ->with('success', 'Donation deleted successfully.');
    }

    public function approve(Donation $donation): RedirectResponse
    {
        $this->donationService->updateDonation($donation, ['approval_status' => 'approved']);

        return redirect()->route('admin.donations.index')
            ->with('success', 'Donation approved successfully.');
    }

    public function reject(Donation $donation): RedirectResponse
    {
        $this->donationService->updateDonation($donation, ['approval_status' => 'rejected']);

        return redirect()->route('admin.donations.index')
            ->with('success', 'Donation rejected successfully.');
    }


    
} 