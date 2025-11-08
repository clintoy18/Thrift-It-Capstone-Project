<?php

namespace App\Services;

use App\Repositories\DonationRepository;
use Illuminate\Support\Facades\Storage;
use App\Models\Segment;

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

          // 2️⃣ Handle uploaded images (store in S3)
        if ($images && count($images) > 0) {
            foreach ($images as $image) {
                if ($image instanceof \Illuminate\Http\UploadedFile) {

                    // Store image in S3 under 'products_images' folder
                    $path = $image->store('donation_images', [
                        'disk' => 's3',
                        'visibility' => 'public',
                    ]);

                    // Save record in donation_images table
                    $donation->donationImages()->create([
                        'image' => $path, // store the S3 key/path
                    ]);
                }
            }
        }

        return $donation;
    }

    public function updateDonation($donation, array $data, $donationImages = null)
    {
         // 1️⃣ Handle main image
        if (!empty($donationImages['main']) && $donationImages['main'] instanceof \Illuminate\Http\UploadedFile) {
            // Delete old main image from S3 if exists
            if ($donation->image && Storage::disk('s3')->exists($donation->image)) {
                Storage::disk('s3')->delete($donation->image);
            }

            // Store new main image in S3
            $data['image'] = $donationImages['main']->store('donation_images', [
                'disk' => 's3',
                'visibility' => 'public',
            ]);
        }


        return $this->donationRepository->update($donation, $data);
    }

    public function deleteDonation($donation)
    {
        return $this->donationRepository->delete($donation);
    }

    public function getApprovedDonationsBySegment(Segment $segment, ?int $categoryId = null)
    {
        return $this->donationRepository->getApprovedDonationsBySegement($segment, $categoryId);
    }

    public function getApprovedDonations()
    {
        return $this->donationRepository->all();
    }

    public function getDonationsByStatusPaginated(string $status, int $perPage = 10)
    {
        return $this->donationRepository->getByStatusPaginated($status, $perPage);
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
