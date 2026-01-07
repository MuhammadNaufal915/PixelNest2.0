<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::where('role', 'user')->count(),
            'total_artworks' => Artwork::count(),
            'pending_artworks' => Artwork::where('status', 'pending')->count(),
            'total_orders' => Order::count(),
            'total_revenue' => Order::where('status', 'paid')->sum('total_amount'),
        ];

        $recentOrders = Order::with('user')->latest()->limit(5)->get();
        $pendingArtworks = Artwork::with(['user', 'category'])
            ->where('status', 'pending')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'pendingArtworks'));
    }
}
