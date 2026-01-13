<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        // Get artworks with relationships (same as welcome page)
        $artworks = Artwork::with(['user', 'category'])
            ->where('status', 'approved')
            ->where('is_active', true)
            ->latest()
            ->take(12)
            ->get();
        
        // Get categories with artwork count (same as welcome page)
        $categories = Category::withCount('artworks')->get();

        return view('user.dashboard', compact('artworks', 'categories'));
    }
}