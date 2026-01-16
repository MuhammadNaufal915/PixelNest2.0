<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtworkController extends Controller
{
    public function index()
    {
        $artworks = auth()->user()->artworks()->with('category')->latest()->paginate(12);
        return view('user.artworks.index', compact('artworks'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('user.artworks.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file' => 'required|mimes:zip,pdf,ai,psd,sketch,fig|max:10240',
        ]);

        $imagePath = $request->file('image')->store('artworks/images', 'public');
        $filePath = $request->file('file')->store('artworks/files', 'public');

        auth()->user()->artworks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'image_path' => $imagePath,
            'file_path' => $filePath,
            'status' => 'approved', // Set to approved by default so it shows up immediately
            'is_active' => true,
        ]);

        return redirect()->route('user.artworks.index')->with('success', 'Artwork uploaded! Waiting for admin approval.');
    }

    public function edit(Artwork $artwork)
    {
        if (!auth()->user()->can('manage-artwork', $artwork)) {
            abort(403);
        }

        $categories = Category::all();
        return view('user.artworks.edit', compact('artwork', 'categories'));
    }

    public function update(Request $request, Artwork $artwork)
    {
        if (!auth()->user()->can('manage-artwork', $artwork)) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file' => 'nullable|mimes:zip,pdf,ai,psd,sketch,fig|max:10240',
        ]);

        $data = $request->only(['title', 'description', 'category_id', 'price']);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($artwork->image_path);
            $data['image_path'] = $request->file('image')->store('artworks/images', 'public');
        }

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($artwork->file_path);
            $data['file_path'] = $request->file('file')->store('artworks/files', 'public');
        }

        // Reset status to pending if content changed
        if ($request->hasFile('image') || $request->hasFile('file')) {
            $data['status'] = 'pending';
        }

        $artwork->update($data);

        return redirect()->route('user.artworks.index')->with('success', 'Artwork updated successfully!');
    }

    public function destroy(Artwork $artwork)
    {
        if (!auth()->user()->can('manage-artwork', $artwork)) {
            abort(403);
        }

        Storage::disk('public')->delete([$artwork->image_path, $artwork->file_path]);
        $artwork->delete();

        return redirect()->route('user.artworks.index')->with('success', 'Artwork deleted successfully!');
    }
}