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
<<<<<<< HEAD

=======
>>>>>>> 6c9d1f181de761f38531d11c96559cf0ad585280
        return back()->with('success', 'Artwork approved successfully!');
    }

    public function reject(Artwork $artwork)
    {
        $artwork->update(['status' => 'rejected']);
<<<<<<< HEAD

        return back()->with('success', 'Artwork rejected!');
=======
        return back()->with('success', 'Artwork rejected.');
    }

    public function toggleActive(Artwork $artwork)
    {
        $artwork->update(['is_active' => !$artwork->is_active]);
        $status = $artwork->is_active ? 'activated' : 'deactivated';
        return back()->with('success', "Artwork {$status} successfully!");
>>>>>>> 6c9d1f181de761f38531d11c96559cf0ad585280
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        $users = \App\Models\User::where('role', 'user')->get();

        return view('admin.artworks.create', compact('categories', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|max:5120',
            'file' => 'required|file|max:51200',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        // Upload image
        $imagePath = $request->file('image')->store('artworks/images', 'public');

        // Upload file
        $filePath = $request->file('file')->store('artworks/files', 'public');

        Artwork::create([
            'user_id' => $validated['user_id'],
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'image_path' => $imagePath,
            'file_path' => $filePath,
            'status' => $validated['status'],
            'is_active' => true,
        ]);

        return redirect()->route('admin.artworks.index')
            ->with('success', 'Artwork created successfully!');
    }

    public function edit(Artwork $artwork)
    {
        $categories = \App\Models\Category::all();
        $users = \App\Models\User::where('role', 'user')->get();

        return view('admin.artworks.edit', compact('artwork', 'categories', 'users'));
    }

    public function update(Request $request, Artwork $artwork)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:5120',
            'file' => 'nullable|file|max:51200',
            'status' => 'required|in:pending,approved,rejected',
            'is_active' => 'boolean',
        ]);

        // Update image if new one uploaded
        if ($request->hasFile('image')) {
            // Delete old image
            if ($artwork->image_path && Storage::exists('public/' . $artwork->image_path)) {
                Storage::delete('public/' . $artwork->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('artworks/images', 'public');
        }

        // Update file if new one uploaded
        if ($request->hasFile('file')) {
            // Delete old file
            if ($artwork->file_path && Storage::exists('public/' . $artwork->file_path)) {
                Storage::delete('public/' . $artwork->file_path);
            }
            $validated['file_path'] = $request->file('file')->store('artworks/files', 'public');
        }

        $artwork->update($validated);

        return redirect()->route('admin.artworks.index')
            ->with('success', 'Artwork updated successfully!');
    }

    public function destroy(Artwork $artwork)
    {
<<<<<<< HEAD
        // Delete files
        if ($artwork->image_path && Storage::exists('public/' . $artwork->image_path)) {
            Storage::delete('public/' . $artwork->image_path);
        }

        if ($artwork->file_path && Storage::exists('public/' . $artwork->file_path)) {
            Storage::delete('public/' . $artwork->file_path);
        }
=======
        Storage::disk('public')->delete([$artwork->image_path, $artwork->file_path]);
        $artwork->forceDelete(); // Permanent delete
>>>>>>> 6c9d1f181de761f38531d11c96559cf0ad585280

        return redirect()->route('admin.artworks.index')->with('success', 'Artwork deleted permanently!');
    }
}