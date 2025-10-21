<?php

namespace App\Services;

use App\Repositories\DonationRepository;
use Illuminate\Support\Facades\Storage;

class DonationService
{
    protected $donationRepository;

    public function __construct(DonationRepository $donationRepository)
    {
        $this->donationRepository = $donationRepository;
    }

    public function getAllDonations()
    {
        return $this->donationRepository->all();
    }

    public function getDonationById($id)
    {
        return $this->donationRepository->find($id);
    }

    public function createDonation(array $data, ?array $images = null)
    {
        // 1️⃣ Create donation record first
        $donation = $this->donationRepository->create($data);

        // 2️⃣ If there are uploaded images, save them
        if ($images && count($images) > 0) {
            foreach ($images as $image) {
                $path = $image->store('donation_images', 'public');

                $donation->images()->create([
                    'image' => $path,
                ]);
            }
        }

        return $donation;
    }

    public function updateDonation($donation, array $data, $images = null)
    {
        if ($images) {
            foreach ($images as $image) {
                $path = $image->store('donation_images', 'public');
                $donation->images()->create(['image' => $path]);
            }
        }

        return $this->donationRepository->update($donation, $data);
    }

    public function deleteDonation($donation)
    {
        return $this->donationRepository->delete($donation);
    }

        public function getDonationsByUser($userId)
        {
            return $this->donationRepository->getByUser($userId);
        }

        public function getMoreDonationsByUser($userId, $excludeDonationId, $limit = 6)
        {
            return $this->donationRepository->getMoreByUser($userId, $excludeDonationId, $limit);
        }

}
