<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use Illuminate\Http\Request;

class ArtworkController extends Controller
{
    public function show(Artwork $artwork)
    {
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
            ->where('id', '!=', $artwork->id)
            ->limit(4)
            ->get();

        return view('artworks.show', compact('artwork', 'relatedArtworks', 'userCanReview', 'userReview'));
    }
}
