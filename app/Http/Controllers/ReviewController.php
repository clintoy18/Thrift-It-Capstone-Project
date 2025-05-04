<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreReviewRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use Illuminate\View\View;


class ReviewController extends Controller
{
    
    public function index(){

        $submittedReviews = Review::where('reviewer_id',Auth::id())->get();

        return view('reviews.index',compact('submittedReviews'));
    }


    public function create(User $user): View
    {
        if ($user->id === Auth::id()) {
            abort(403, 'You cannot review yourself.');
        }

        return view('reviews.create', compact('user'));
    }

    public function store(StoreReviewRequest $request, User $user){

       if(Auth::id() === $user->id){
        return redirect()->back()->withError('You cannot review yourself');
       }


       $exisitingReview = Review::where('reviewer_id', Auth::id())
            ->where('reviewed_user_id', $user->id)
            ->first();

       if($exisitingReview){
        return redirect()->back()->withError('You have already reviewed this user');
       }

       $validated = $request->validated();
       $validated['reviewer_id'] = Auth::id();
       $validated['reviewed_user_id'] = $user->id;

       Review::create($validated);

       return redirect()->route('dashboard')->with('success','Review submitted succesfully!');
    }
    


    public function show(Review $review){

        $review->load(['reviewer', 'reviewedUser']);

        return view('reviews.show',compact('review'));
    }
}
