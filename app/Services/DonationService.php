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

    public function createDonation(array $data , $images = null)
    {
        // Support multiple images (array) or single file
        $storedPaths = [];
        if (is_array($images)) {
            foreach ($images as $img) {
                if ($img) {
                    $storedPaths[] = $img->store('donations_images', 'public');
                }
            }
        } elseif ($images) {
            $storedPaths[] = $images->store('donations_images', 'public');
        }

        if (!empty($storedPaths)) {
            $data['image'] = $storedPaths[0];
            $data['images'] = json_encode($storedPaths);
        }
        return $this->donationRepository->create($data);
    }
    public function updateDonation(Donation $donation, array $data, $images = null)
    {
        // Support updating image(s) with array or single
        if ($images) {
            // Delete old primary image if present
            if ($donation->image) {
                Storage::delete('public/'.$donation->image);
            }

            $storedPaths = [];
            if (is_array($images)) {
                foreach ($images as $img) {
                    if ($img) {
                        $storedPaths[] = $img->store('donations_images', 'public');
                    }
                }
            } else {
                $storedPaths[] = $images->store('donations_images', 'public');
            }

            if (!empty($storedPaths)) {
                $data['image'] = $storedPaths[0];
                $data['images'] = json_encode($storedPaths);
            }
        }
        return $this->donationRepository->update($donation, $data);
    }

    public function deleteDonation(Donation $donation)
    {
        return $this->donationRepository->delete($donation);
    }

    public function getMoreDonationsByUser($userId, $excludeDonationId, $limit = 6)
    {
        return $this->donationRepository->getMoreByUser($userId, $excludeDonationId, $limit);
    }
   
}

