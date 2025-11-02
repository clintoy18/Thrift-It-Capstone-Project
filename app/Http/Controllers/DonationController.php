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
use App\Http\Requests\SubmitProofAction as SubmitProofRequest;

use App\Models\Donation;
use App\Models\Comment;

use Illuminate\Http\RedirectResponse;

class DonationController extends Controller
{

    protected $donationService;
    public function __construct(DonationService $donationService)
    {
        $this->donationService = $donationService;
    }
    public function index(): View
    {
        $donations = $this->donationService->getDonationsByUser(Auth::id());
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
   
    public function store(StoreDonationRequest $request)
    {
        // Validate request data
        $validated = $request->validated();

        // Attach authenticated user ID
        $validated['user_id'] = Auth::id();

        // Handle images safely (if any)
        $images = $request->hasFile('images') ? $request->file('images') : [];

        // Create donation via service layer
        $this->donationService->createDonation($validated, $images);

        // Redirect with success message
        return redirect()
            ->route('donations.index')
            ->with('success', 'Donation created successfully!');
    }


    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        Cache::forget("donation_{$id}_comments");
        Cache::forget("donation_{$id}_with_comments");

        $donation = Donation::with(['user', 'category', 'donationImages'])->findOrFail($id);
        $allComments = Comment::with(['user'])
            ->where('donation_id', $id)
            ->orderBy('created_at', 'asc')
            ->get();

        $byParent = $allComments->groupBy('parent_id');
        $topLevel = $byParent->get(null, collect())->sortByDesc('created_at')->values();

        $topLevel->each(function ($root) use ($byParent) {
            $flatReplies = collect();
            $stack = [];
            foreach ($byParent->get($root->id, collect()) as $child) {
                $flatReplies->push($child);
                $stack[] = $child;
            }
            while (!empty($stack)) {
                $node = array_pop($stack);
                foreach ($byParent->get($node->id, collect()) as $child) {
                    $flatReplies->push($child);
                    $stack[] = $child;
                }
            }
            $root->setRelation('replies', $flatReplies);
        });

        $donation->setRelation('comments', $topLevel);

        $moreDonations = $this->donationService->getMoreDonationsByUser($donation->user_id, $donation->id);

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
        $donations = $this->donationService->getApprovedDonations();
        return view('donations.donation-hub', compact('donations'));
    }

    public function markAsDonated(SubmitProofRequest $request, Donation $donation): RedirectResponse
    {
        // Store proof image
        $proofPath = $request->file('proof')->store('proofs', 'public');

        $this->donationService->updateDonation($donation, [
            'proof' => $proofPath,
            'verification_status' => 'pending',
        ]);

        return redirect()
            ->route('donations.index')
            ->with('success', 'Proof submitted successfully! Awaiting admin verification to redeem points.');
    }

}
