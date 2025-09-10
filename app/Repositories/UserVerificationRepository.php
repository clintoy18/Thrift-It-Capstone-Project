<?php
namespace App\Repositories;

use App\Models\User;

class UserVerificationRepository
{
    public function submitDocument(User $user, $documentPath)
    {
        return $user->update([
            'verification_document' => $documentPath,
            'verification_status' => 'pending',
            'is_verified' => false,
        ]);
    }

    public function findById($id)
    {
        return User::find($id);
    }

    public function all()
    {
        return User::orderBy('lname','asc');
    }

    public function getVerifiedUsers()
    {
         return User::where('is_verified', true)->orWhere('verification_status','approved')->orderBy('lname','asc');
    }

    public function getPendingVerifications()
    {
        return User::where('verification_status', 'pending')->get();
    }

    public function updateStatus(User $user, $status)
    {
        return $user->update([
            'verification_status' => $status,
            'is_verified' => $status === 'approved',
        ]);
    }
}