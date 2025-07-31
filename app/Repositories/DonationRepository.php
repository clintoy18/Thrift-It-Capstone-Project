<?php

namespace App\Repositories;

use App\Models\Donation;

class DonationRepository
{
    public function all()
    {
        return Donation::all();
    }

    public function find($id)
    {
        return Donation::findOrFail($id);
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
        return Donation::where('user_id', $userId)->get();
    }
    public function findWithRelations($id)
    {
        return Donation::with(['user','category','comments'])->findOrFail($id);
    }
    

}
