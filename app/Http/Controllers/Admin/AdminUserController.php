<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\UserVerificationService; 
use App\Models\Report;

class AdminUserController extends Controller

{

     protected $service;

    public function __construct(UserVerificationService $service)
    {
        $this->service = $service;
    }

    public function index(): View
    {
        $users =  $this->service->verified()->paginate(10);
        $pendingUsers = $this->service->pending();
        // dd($pendingVerifications);
        return view('admin.users.index', compact('users','pendingUsers'));
    }
    
    public function show(User $user): View
    {
        $user->load(['products', 'reportsReceived']);
        return view('admin.users.show', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'is_active' => 'boolean',
            'verification_status' => 'in:pending,approved,rejected',
            'is_verified' => 'boolean',

        ]);

        $user->update($validated);

        return redirect()->route('admin.users.show', $user)
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }

    

  
} 