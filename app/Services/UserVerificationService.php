<?php
namespace App\Services;

use App\Models\User;
use App\Repositories\UserVerificationRepository;

class UserVerificationService
{
    protected $repo;

    public function __construct(UserVerificationRepository $repo)
    {
        $this->repo = $repo;
    }

    public function all()
    {
         return User::orderBy('lname', 'asc');
    }

    public function submit(User $user, $document)
    {
        $path = $document->store('verification_docs', 'public');
        return $this->repo->submitDocument($user, $path);
    }

    public function pending()
    {
        return $this->repo->getPendingVerifications();
    }

    public function verified()
    {
        return $this->repo->getVerifiedUsers();
    }

    public function update(User $user, $status)
    {
        return $this->repo->updateStatus($user, $status);
    }
}