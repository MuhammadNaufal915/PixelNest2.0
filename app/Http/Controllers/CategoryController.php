<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('artworks')->get();
        return view('categories.index', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        $artworks = $category->artworks()
            ->whereIn('status', ['approved', 'pending'])
            ->where('is_active', true)
            ->latest()
            ->paginate(12);
        
        return view('categories.show', compact('category', 'artworks'));
    }
}
