<?php

namespace App\Http\Controllers;

use App\Models\Artwork;

class ArtworkController extends Controller
{
    public function index()
    {
        $artworks = Artwork::with(['user', 'category'])
            ->where('status', 'approved')
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('artworks.index', compact('artworks'));
    }

    public function show(Artwork $artwork)
    {
<<<<<<< HEAD
        // Only show if approved and active
        if ($artwork->status !== 'approved' || !$artwork->is_active) {
            abort(404);
        }

        $artwork->load(['user', 'category', 'reviews.user']);

        // Check if current user can review (authenticated, purchased, hasn't reviewed yet)
        $userCanReview = false;
        $userReview = null;

        if (auth()->check()) {
            $user = auth()->user();
            $userCanReview = $user->hasPurchased($artwork) &&
                !$artwork->reviews()->where('user_id', $user->id)->exists();
            $userReview = $artwork->reviews()->where('user_id', $user->id)->first();
        }

        // Get related artworks
        $relatedArtworks = Artwork::available()
            ->where('category_id', $artwork->category_id)
=======
        $artwork->load(['user', 'category']);
        
        $relatedArtworks = Artwork::where('category_id', $artwork->category_id)
>>>>>>> 6c9d1f181de761f38531d11c96559cf0ad585280
            ->where('id', '!=', $artwork->id)
            ->take(4)
            ->get();

        return view('artworks.show', compact('artwork', 'relatedArtworks', 'userCanReview', 'userReview'));
    }
}