<?php

namespace App\Services;

use App\Repositories\ReviewRepository;
use App\Models\Review;

class ReviewService
{
    protected $reviewRepository;

    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function getSubmittedReviews($userId)
    {
        return $this->reviewRepository->getSubmittedReviews($userId);
    }

    public function createReview(array $data)
    {
        return $this->reviewRepository->create($data);
    }

    public function findReview($id)
    {
        return $this->reviewRepository->find($id);
    }

    public function updateReview($reviewId, array $data)
    {
        $review = $this->reviewRepository->find($reviewId);
        return $this->reviewRepository->update($review, $data);
    }

    public function deleteReview($reviewId)
    {
        $review = $this->reviewRepository->find($reviewId);
        return $this->reviewRepository->delete($review);
    }

    public function findExistingReview($reviewerId, $reviewedUserId)
    {
        return Review::where('reviewer_id', $reviewerId)
            ->where('reviewed_user_id', $reviewedUserId)
            ->first();
    }
}
