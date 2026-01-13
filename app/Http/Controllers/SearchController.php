<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');
        
        $artworks = Artwork::where('status', 'approved')
            ->where('is_active', true)
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->with(['category', 'user'])
            ->latest()
            ->paginate(12);
        
        return view('artworks.search', compact('artworks', 'query'));
    }
}
