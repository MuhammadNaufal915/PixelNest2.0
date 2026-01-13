<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtworkController extends Controller
{
    public function index(Request $request)
    {
        $query = Artwork::with(['user', 'category']);
        
        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $artworks = $query->latest()->paginate(15);
        return view('admin.artworks.index', compact('artworks'));
    }

    public function show(Artwork $artwork)
    {
        $artwork->load(['user', 'category', 'orderItems.order']);
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
        return back()->with('success', 'Artwork rejected.');
    }

    public function toggleActive(Artwork $artwork)
    {
        $artwork->update(['is_active' => !$artwork->is_active]);
        $status = $artwork->is_active ? 'activated' : 'deactivated';
        return back()->with('success', "Artwork {$status} successfully!");
    }

    public function destroy(Artwork $artwork)
    {
        Storage::disk('public')->delete([$artwork->image_path, $artwork->file_path]);
        $artwork->forceDelete(); // Permanent delete

        return redirect()->route('admin.artworks.index')->with('success', 'Artwork deleted permanently!');
    }
}