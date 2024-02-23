<?php

namespace App\Http\Repositories;

use App\Models\Review;

class ReviewRepository
{
    public function createReview ($data)
    {
        $review = Review::create($data);
        return $review;
    }
}