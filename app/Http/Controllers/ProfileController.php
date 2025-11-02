<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Barangay;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Storage;



class ProfileController extends Controller
{

    
 
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {

        $user = $request->user(); // logged-in user only
         $barangays = Barangay::all();

        $totalListings = $user->products()->count();
        $itemsSold = $user->products()->where('status', 'sold')->count();
        $revenue = $user->products()->where('status', 'sold')->sum('price');
        $itemsDonated = $user->donations()->where('status', 'donated')->count();
        // $unreadMessages = $user->receivedMessages()->where('is_read', false)->count();

        return view('profile.edit', compact(
            'user',
            'totalListings',
            'itemsSold',
            'revenue',
            'itemsDonated',
            'barangays'
        ));
    }

    /**
     * Display the user's password update form.
     */
    public function edit1(Request $request): View
    {
        $user = $request->user();
        return view('profile.edit1', compact('user'));
    }

    /**
     * Display the user's data & privacy settings.
     */
    public function edit2(Request $request): View
    {
        $user = $request->user();
        return view('profile.edit2', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Get all validated fields
        $validated = $request->validated();

        // ✅ Handle profile picture upload (optional)
        if ($request->hasFile('profile_pic')) {
            $path = $request->file('profile_pic')->store('profile-pictures', 'public');
            $validated['profile_pic'] = $path;
        }

        // ✅ Allow Barangay updates
        if ($request->filled('barangay_id')) {
            $validated['barangay_id'] = $request->barangay_id;
        }

        // ✅ Fill all updated fields into the user model
        $user->fill($validated);

        // ✅ Reset email verification if changed
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // ✅ Save changes
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }



    public function show(User $user)
    {
        // Available products (status not sold)
        $availableProducts = $user->products()->where('status', '!=', 'sold')->get();

        // Sold products
        $soldProducts = $user->products()->where('status', 'sold')->get();

        // Orders received for this user's products
        $orders = $user->ordersAsSeller()->with(['product', 'buyer'])->get();

        // Dashboard statistics (only for profile owner)
        $totalListings = $user->products()->count();
        $itemsSold = $user->products()->where('status', 'sold')->count();
        $revenue = $user->products()->where('status', 'sold')->sum('price');
        $itemsDonated = $user->donations()->where('status', 'donated')->count();

        return view('profile.show', [
            'user' => $user,
            'availableProducts' => $availableProducts,
            'soldProducts' => $soldProducts,
            'orders' => $orders,
            'totalListings' => $totalListings,
            'itemsSold' => $itemsSold,
            'revenue' => $revenue,
            'itemsDonated' => $itemsDonated,
        ]);
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function uploadVerificationDocument(Request $request)
    {
        $request->validate([
            'verification_document' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('verification_document')) {
            $path = $request->file('verification_document')->store('verification-documents', 'public');

            $request->user()->update([
                'verification_document' => $path,
                'verification_status' => 'pending',
            ]);
        }

        return back()->with('status', 'Verification document uploaded successfully and sent for review.');
    }

    public function uploadProfilePic(Request $request)
    {
        $request->validate([
            'profile_pic' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = $request->user();

        // Store new picture
        $path = $request->file('profile_pic')->store('profile-pictures', 'public');

        // Update user record
        $user->update(['profile_pic' => $path]);

        return back()->with('status', 'Profile picture updated successfully!');
    }
}
