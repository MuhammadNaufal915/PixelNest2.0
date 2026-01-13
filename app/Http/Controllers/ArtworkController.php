<?php

namespace App\Http\Controllers;

use App\Models\Artwork;

class ArtworkController extends Controller
{
    public function show(Artwork $artwork)
    {
        $artwork->load(['user', 'category']);
        
        $relatedArtworks = Artwork::where('category_id', $artwork->category_id)
            ->where('id', '!=', $artwork->id)
            ->take(4)
            ->get();

        return view('artworks.show', compact('artwork', 'relatedArtworks'));
    }
}