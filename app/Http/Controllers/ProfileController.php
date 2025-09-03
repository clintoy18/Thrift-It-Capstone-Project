<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {

        $user = $request->user(); // logged-in user only

        $totalListings = $user->products()->count();
        $itemsSold = $user->products()->where('status', 'sold')->count();
        $revenue = $user->products()->where('status', 'sold')->sum('price');
        $itemsDonated = $user->donations()->where('status', 'donated')->count();
       // $unreadMessages = $user->receivedMessages()->where('is_read', false)->count();

        return view('profile.edit', compact(
        'user', 'totalListings', 'itemsSold', 'revenue','itemsDonated'));
    
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function show(User $user){


        return view('profile.show',[
            'user' => $user,
            'products' => $user->products,
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

}