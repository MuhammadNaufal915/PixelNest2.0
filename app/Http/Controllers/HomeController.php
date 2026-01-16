<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $query = Artwork::with(['user', 'category'])
            ->available();

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Sort by rating or reviews count
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'rating':
                    $query->orderBy('average_rating', 'desc')->orderBy('reviews_count', 'desc');
                    break;
                case 'reviews':
                    $query->orderBy('reviews_count', 'desc')->orderBy('average_rating', 'desc');
                    break;
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }

        $artworks = $query->paginate(12);
=======
        $artworks = Artwork::with(['user', 'category'])
            ->whereIn('status', ['approved', 'pending'])
            ->where('is_active', true)
            ->latest()
            ->take(12)
            ->get();
        
>>>>>>> 6c9d1f181de761f38531d11c96559cf0ad585280
        $categories = Category::withCount('artworks')->get();

        return view('welcome', compact('artworks', 'categories'));
    }
}