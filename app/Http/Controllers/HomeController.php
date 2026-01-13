<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $artworks = Artwork::with(['user', 'category'])
            ->whereIn('status', ['approved', 'pending'])
            ->where('is_active', true)
            ->latest()
            ->take(12)
            ->get();
        
        $categories = Category::withCount('artworks')->get();

        return view('welcome', compact('artworks', 'categories'));
    }
}