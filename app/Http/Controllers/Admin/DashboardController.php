<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Artwork;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $usersCount = User::where('role', 'user')->count();
        $artworksCount = Artwork::count();
        $ordersCount = Order::where('status', 'paid')->count();
        $totalRevenue = Order::where('status', 'paid')->sum('total_amount');

        $recentOrders = Order::with('user')->latest()->take(5)->get();
        $recentArtworks = Artwork::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'usersCount',
            'artworksCount',
            'ordersCount',
            'totalRevenue',
            'recentOrders',
            'recentArtworks'
        ));
    }
}