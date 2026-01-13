<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')
            ->withCount('artworks')
            ->latest()
            ->paginate(15);
        
        return view('admin.users.index', compact('users'));
    }
}