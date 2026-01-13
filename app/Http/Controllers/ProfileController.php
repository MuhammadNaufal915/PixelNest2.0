<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Artwork;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        $artworks = Artwork::where('user_id', $id)
            ->whereIn('status', ['approved', 'pending'])
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('profile.show', compact('user', 'artworks'));
    }
}
