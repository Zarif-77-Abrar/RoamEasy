<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Destination;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Tourist: Store a review
    public function store(Request $request, $destinationId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $review = Review::create([
            'user_id' => auth()->id(),
            'destination_id' => $destinationId,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Update avg rating
        $review->destination->updateAverageRating();

        return back()->with('success', 'Review added successfully.');
    }

    // Admin: View all reviews
    public function index()
    {
        $reviews = Review::with(['user', 'destination'])->latest()->paginate(10);
        return view('admin.reviews.index', compact('reviews'));
    }

    // Admin: Delete a review
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $destination = $review->destination;
        $review->delete();

        // Update avg rating
        $destination->updateAverageRating();

        return back()->with('success', 'Review deleted successfully.');
    }


    // app/Http/Controllers/ReviewController.php
    public function showForDestination($destinationId)
    {
        $destination = Destination::findOrFail($destinationId);
        $reviews = Review::with('user')
            ->where('destination_id', $destinationId)
            ->latest()
            ->paginate(10);

        return view('reviews.show', compact('destination', 'reviews'));
    }
}






