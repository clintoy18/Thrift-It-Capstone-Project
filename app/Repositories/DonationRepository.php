<?php

namespace App\Repositories;

use App\Models\Donation;
use App\Models\Segment;

class DonationRepository
{
    public function all()
    {
        return Donation::
        where('approval_status','approved')
        ->with('images')->get();
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

     public function getApprovedDonations(Segment $segment, ?int $categoryId = null)
    {
        $query = $segment->products()
            ->where('approval_status', 'approved')
            ->where('status', 'available')
            ->with(['category', 'images']);

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        return $query->get();
    }


   public function getByStatusPaginated(string $status, int $perPage = 10)
    {
        return Donation::with(['user', 'category'])
            ->where('approval_status', $status)  
            ->latest()
            ->paginate($perPage);
    }

}
