<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtworkController extends Controller
{
    public function index(Request $request)
    {
        $query = Artwork::with(['user', 'category']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $artworks = $query->latest()->paginate(15);

        return view('admin.artworks.index', compact('artworks'));
    }

    public function show(Artwork $artwork)
    {
        $artwork->load(['user', 'category']);
        return view('admin.artworks.show', compact('artwork'));
    }

    public function approve(Artwork $artwork)
    {
        $artwork->update(['status' => 'approved']);
        
        return back()->with('success', 'Artwork approved successfully!');
    }

    public function reject(Artwork $artwork)
    {
        $artwork->update(['status' => 'rejected']);
        
        return back()->with('success', 'Artwork rejected!');
    }

    public function destroy(Artwork $artwork)
    {
        // Delete files
        if ($artwork->image_path && Storage::exists('public/' . $artwork->image_path)) {
            Storage::delete('public/' . $artwork->image_path);
        }
        
        if ($artwork->file_path && Storage::exists('public/' . $artwork->file_path)) {
            Storage::delete('public/' . $artwork->file_path);
        }

        $artwork->delete();

        return redirect()->route('admin.artworks.index')
            ->with('success', 'Artwork deleted successfully!');
    }
}
