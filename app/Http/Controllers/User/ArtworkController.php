<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArtworkController extends Controller
{
    public function index()
    {
        $artworks = auth()->user()->artworks()->with('category')->latest()->get();
        return view('user.artworks.index', compact('artworks'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('user.artworks.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|max:5120', // 5MB max
            'file' => 'required|file|max:51200', // 50MB max
        ]);

        // Handle image upload
        $imagePath = $request->file('image')->store('artworks/images', 'public');
        
        // Handle file upload
        $filePath = $request->file('file')->store('artworks/files', 'public');

        auth()->user()->artworks()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'price' => $validated['price'],
            'image_path' => $imagePath,
            'file_path' => $filePath,
            'status' => 'pending', // Needs admin approval
        ]);

        return redirect()->route('user.artworks.index')
            ->with('success', 'Artwork uploaded successfully! Waiting for admin approval.');
    }

    public function edit(Artwork $artwork)
    {
        // Check ownership
        if ($artwork->user_id !== auth()->id()) {
            abort(403);
        }

        $categories = Category::all();
        return view('user.artworks.edit', compact('artwork', 'categories'));
    }

    public function update(Request $request, Artwork $artwork)
    {
        // Check ownership
        if ($artwork->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:5120',
            'file' => 'nullable|file|max:51200',
        ]);

        $updateData = [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'price' => $validated['price'],
        ];

        // Handle new image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if (Storage::exists('public/' . $artwork->image_path)) {
                Storage::delete('public/' . $artwork->image_path);
            }
            $updateData['image_path'] = $request->file('image')->store('artworks/images', 'public');
        }

        // Handle new file upload
        if ($request->hasFile('file')) {
            // Delete old file
            if (Storage::exists('public/' . $artwork->file_path)) {
                Storage::delete('public/' . $artwork->file_path);
            }
            $updateData['file_path'] = $request->file('file')->store('artworks/files', 'public');
        }

        $artwork->update($updateData);

        return redirect()->route('user.artworks.index')
            ->with('success', 'Artwork updated successfully!');
    }

    public function destroy(Artwork $artwork)
    {
        // Check ownership
        if ($artwork->user_id !== auth()->id()) {
            abort(403);
        }

        // Delete files
        if (Storage::exists('public/' . $artwork->image_path)) {
            Storage::delete('public/' . $artwork->image_path);
        }
        
        if (Storage::exists('public/' . $artwork->file_path)) {
            Storage::delete('public/' . $artwork->file_path);
        }

        $artwork->delete();

        return redirect()->route('user.artworks.index')
            ->with('success', 'Artwork deleted successfully!');
    }

    public function toggleActive(Artwork $artwork)
    {
        // Check ownership
        if ($artwork->user_id !== auth()->id()) {
            abort(403);
        }

        $artwork->update(['is_active' => !$artwork->is_active]);

        $status = $artwork->is_active ? 'activated' : 'deactivated';
        return back()->with('success', "Artwork {$status} successfully!");
    }
}
