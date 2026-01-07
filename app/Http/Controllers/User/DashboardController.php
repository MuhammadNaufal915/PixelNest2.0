<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $stats = [
            'total_artworks' => $user->artworks()->count(),
            'approved_artworks' => $user->artworks()->where('status', 'approved')->count(),
            'total_sales' => Order::whereHas('items.artwork', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })->where('status', 'paid')->sum('total_amount'),
            'total_purchases' => $user->orders()->where('status', 'paid')->count(),
        ];

        $recentArtworks = $user->artworks()->latest()->limit(5)->get();
        $recentOrders = $user->orders()->latest()->limit(5)->get();

        return view('user.dashboard', compact('stats', 'recentArtworks', 'recentOrders'));
    }
}
