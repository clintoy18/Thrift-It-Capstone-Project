<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DonationService;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
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
        $donations = $this->donationService->getAllDonations();
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
        $donation = $this->donationService->getDonationWithRelations($id);
        // return dd($donation);
        return view('donations.show',compact('donation'));

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
}
