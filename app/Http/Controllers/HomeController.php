<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
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
            if ($request->sort === 'rating') {
                $query->orderBy('average_rating', 'desc')->orderBy('reviews_count', 'desc');
            } elseif ($request->sort === 'reviews') {
                $query->orderBy('reviews_count', 'desc')->orderBy('average_rating', 'desc');
            } else {
                $query->latest();
            }
        } else {
            $query->latest();
        }

        $artworks = $query->paginate(12);
        $categories = Category::withCount('artworks')->get();

        return view('home', compact('artworks', 'categories'));
    }
}
