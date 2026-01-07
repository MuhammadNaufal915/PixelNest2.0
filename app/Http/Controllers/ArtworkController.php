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

        $artwork->load(['user', 'category']);
        
        // Get related artworks
        $relatedArtworks = Artwork::available()
            ->where('category_id', $artwork->category_id)
            ->where('id', '!=', $artwork->id)
            ->limit(4)
            ->get();

        return view('artworks.show', compact('artwork', 'relatedArtworks'));
    }
}
