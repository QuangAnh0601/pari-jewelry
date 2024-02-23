<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ReviewRepository;
use App\Http\Requests\EditReviewRequest;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct(protected ReviewRepository $reviewRepo)
    {
        
    }

    public function create (EditReviewRequest $request)
    {
        $review = $this->reviewRepo->createReview($request->all());
        return response()->json([
            'data' => $review
        ], 200);
    }
}
