<?php

namespace App\Repositories;

use App\Models\Donation;

class DonationRepository
{
    public function all()
    {
        return Donation::with('images')->get();
    }

    public function find($id)
    {
        return Donation::with('images')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Donation::create($data);
    }

    public function update(Donation $donation, array $data)
    {
        $donation->update($data);
        return $donation;
    }

    public function delete(Donation $donation)
    {
        return $donation->delete();
    }

    public function getByUser($userId)
    {
        return Donation::where('user_id', $userId)
            ->with('images')
            ->latest()
            ->get();
    }

    public function getMoreByUser($userId, $excludeDonationId, $limit = 6)
    {
        return Donation::where('user_id', $userId)
            ->where('id', '!=', $excludeDonationId)
            ->with('images')
            ->latest()
            ->take($limit)
            ->get();
    }
}
