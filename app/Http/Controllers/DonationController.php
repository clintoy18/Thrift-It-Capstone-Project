<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DonationService;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Http\Requests\StoreDonationRequest;
use App\Http\Requests\UpdateDonationRequest;
use App\Models\Donation;
use Illuminate\Http\RedirectResponse;

class DonationController extends Controller
{

    protected $donationService;
    public function __construct(DonationService $donationService)
    {
        $this->donationService = $donationService;
    }
   
    public function index() : View
    {
        $userId = Auth::id();
        $donations = $this->donationService->getDonationsByUser($userId);
        return view('donations.index', compact('donations'));
    }
  
    public function create()
    {
        $categories = Categories::all(); 
        return view('donations.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(StoreDonationRequest $request): RedirectResponse
    {
         $validated = $request->validated();
         $validated['user_id'] = Auth::id();
         $this->donationService->createDonation($validated,$request->file('image')?? null);
           
         return redirect()->route('donations.index')->with('success', 'Donation created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Clear cache keys for this donation
        Cache::forget("donation_{$id}_comments");
        Cache::forget("donation_{$id}_with_comments");

        // Load donation base relations
        $donation = Donation::with(['user', 'category'])->findOrFail($id);

        // Fetch only parent comments with their replies + users (mirror ProductController)
        $comments = \App\Models\Comment::with(['user', 'replies.user'])
            ->where('donation_id', $id)
            ->whereNull('parent_id')
            ->latest()
            ->get();

        // Attach comments to donation
        $donation->setRelation('comments', $comments);

        // Get more donations from the same user
        $moreDonations = $this->donationService->getMoreDonationsByUser($donation->user_id, $donation->id);

        // Disable browser cache for this page
        return response()
            ->view('donations.show', compact('donation', 'moreDonations'))
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0')
            ->header('Last-Modified', gmdate('D, d M Y H:i:s') . ' GMT')
            ->header('ETag', md5(serialize($donation->comments)));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $categories = Categories::all();
       $donation = $this->donationService->getDonationById($id);
    
       return view('donations.edit', ['donation' => $donation, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDonationRequest $request, Donation $donation)
    {
        $data = $request->validated();
        $this->donationService->updateDonation($donation, $data, $request->file('image') ?? null);
       
        return redirect()->route('donations.index')->with('success', 'donation updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $donation = $this->donationService->getDonationById($id);
        $donation->delete();
        return redirect()->route('donations.index')->with('success', 'Donation deleted successfully!');
    }

    public function getAllDonations()
    {
        $donations = $this->donationService->getAllDonations();
        return view('donations.donation-hub', compact('donations'));
    }
}
