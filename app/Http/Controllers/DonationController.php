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
        // Clear all cache related to this donation and comments
        Cache::forget("donation_{$id}_comments");
        Cache::forget("donation_{$id}_with_comments");
        
        // Use raw DB query to bypass all caching mechanisms
        $donationData = DB::table('donations')
            ->where('id', $id)
            ->first();
            
        if (!$donationData) {
            abort(404);
        }
        
        // Get comments with raw query to ensure fresh data
        $comments = DB::table('comments')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->where('comments.donation_id', $id)
            ->select('comments.*', 'users.fname', 'users.lname')
            ->orderBy('comments.created_at', 'desc')
            ->get();
        
        // Convert to Eloquent models for compatibility
        $donation = Donation::find($id);
        $donation->load(['user', 'category']);
        
        // Manually attach fresh comments
        $donation->setRelation('comments', $comments->map(function($comment) {
            $commentModel = new \App\Models\Comment();
            $commentModel->id = $comment->id;
            $commentModel->content = $comment->content;
            $commentModel->user_id = $comment->user_id;
            $commentModel->donation_id = $comment->donation_id;
            $commentModel->parent_id = $comment->parent_id;
            $commentModel->created_at = $comment->created_at;
            $commentModel->updated_at = $comment->updated_at;
            
            // Create user model
            $user = new \App\Models\User();
            $user->id = $comment->user_id;
            $user->fname = $comment->fname;
            $user->lname = $comment->lname;
            $commentModel->setRelation('user', $user);
            
            return $commentModel;
        }));
        
        // Disable browser cache for this page
        return response()
            ->view('donations.show', compact('donation'))
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
