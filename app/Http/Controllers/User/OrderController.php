<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->with('items')->latest()->paginate(10);
        return view('user.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Check ownership
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items.artwork.user');
        return view('user.orders.show', compact('order'));
    }

    public function download(Order $order, $artworkId)
    {
        // Check ownership
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Check if order is paid
        if (!$order->isPaid()) {
            abort(403, 'Order must be paid before downloading.');
        }

        // Check if artwork is in this order
        $orderItem = $order->items()->where('artwork_id', $artworkId)->first();
        
        if (!$orderItem) {
            abort(404);
        }

        $artwork = $orderItem->artwork;

        // Increment download count
        $artwork->incrementDownloads();

        // Download file
        return Storage::download('public/' . $artwork->file_path, $artwork->title . '.' . pathinfo($artwork->file_path, PATHINFO_EXTENSION));
    }
}
