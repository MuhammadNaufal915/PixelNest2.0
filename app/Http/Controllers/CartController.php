<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Artwork;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = auth()->user()->cart()->with('items.artwork.user')->first();
        
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, Artwork $artwork)
    {
        // Check if artwork is available
        if ($artwork->status !== 'approved' || !$artwork->is_active) {
            return back()->with('error', 'This artwork is not available for purchase.');
        }

        // Don't allow buying own artwork
        if ($artwork->user_id === auth()->id()) {
            return back()->with('error', 'You cannot purchase your own artwork.');
        }

        // Get or create cart
        $cart = auth()->user()->cart()->firstOrCreate(['user_id' => auth()->id()]);

        // Check if already in cart
        $existingItem = $cart->items()->where('artwork_id', $artwork->id)->first();
        
        if ($existingItem) {
            return back()->with('info', 'This artwork is already in your cart.');
        }

        // Add to cart
        $cart->items()->create(['artwork_id' => $artwork->id]);

        return back()->with('success', 'Artwork added to cart!');
    }

    public function remove(CartItem $cartItem)
    {
        // Check ownership
        if ($cartItem->cart->user_id !== auth()->id()) {
            abort(403);
        }

        $cartItem->delete();

        return back()->with('success', 'Item removed from cart!');
    }
}
