<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a new review for an artwork
     */
    public function store(Request $request, Artwork $artwork)
    {
        // Validate user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk memberikan review.');
        }

        $user = Auth::user();

        // Check if user has purchased this artwork
        if (!$user->hasPurchased($artwork)) {
            return redirect()->back()->with('error', 'Anda hanya bisa memberikan review untuk artwork yang sudah dibeli.');
        }

        // Check if user has already reviewed this artwork
        $existingReview = Review::where('user_id', $user->id)
            ->where('artwork_id', $artwork->id)
            ->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'Anda sudah memberikan review untuk artwork ini.');
        }

        // Validate request
        $validated = $request->validate(Review::rules());

        // Find the paid order that contains this artwork
        $order = $user->orders()
            ->where('status', 'paid')
            ->whereHas('items', function ($query) use ($artwork) {
                $query->where('artwork_id', $artwork->id);
            })
            ->first();

        if (!$order) {
            return redirect()->back()->with('error', 'Order tidak ditemukan.');
        }

        // Create the review
        Review::create([
            'user_id' => $user->id,
            'artwork_id' => $artwork->id,
            'order_id' => $order->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Terima kasih! Review Anda telah ditambahkan.');
    }
}
