<?php

namespace App\Services;

use App\Repositories\DonationRepository;
use App\Models\Donation;
use Illuminate\Support\Facades\Storage;

class DonationService
{
    protected $donationRepository;

    public function __construct(DonationRepository $donationRepository)
    {
        $this->donationRepository = $donationRepository;
    }

    public function getDonationsByUser($userId)
    {
        return $this->donationRepository->getByUser($userId);   
    }

    public function getAllDonations()
    {
        return $this->donationRepository->all();
    }
    public function getDonationWithRelations($id)
    {
        return $this->donationRepository->findWithRelations($id);
    }   
    public function getDonationById($id)
    {
        return $this->donationRepository->find($id);
    }

    public function createDonation(array $data , $image = null)
    {
        // Add business logic here if needed
        if ($image) {
            $data['image'] = $image->store('donations_images', 'public');
        }
        return $this->donationRepository->create($data);
    }
    public function updateDonation(Donation $donation, array $data, $image = null)
    {
        // Add business logic here if needed
        if($image){
            //Delete old image if exists
            if($donation->image){
                Storage::delete('public/'.$donation->image);
            }
            $data['image'] = $image->store('donations_images', 'public');
        }
        return $this->donationRepository->update($donation, $data);
    }

    public function deleteDonation(Donation $donation)
    {
        return $this->donationRepository->delete($donation);
    }
   
}

