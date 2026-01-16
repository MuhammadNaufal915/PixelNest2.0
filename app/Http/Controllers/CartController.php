<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = auth()->user()->cart()->with('items.artwork.user')->first();
        
        if (!$cart) {
            $cartItems = collect();
            $total = 0;
        } else {
            $cartItems = $cart->items->map(function($item) {
                return $item->artwork;
            });
            $total = $cartItems->sum('price');
        }

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, Artwork $artwork)
    {
        if (!auth()->user()->can('purchase-artwork', $artwork)) {
            return back()->with('error', 'You cannot purchase this artwork.');
        }

        // Get or create cart
        $cart = auth()->user()->cart()->firstOrCreate([
            'user_id' => auth()->id()
        ]);

        // Check if already in cart
        $exists = CartItem::where('cart_id', $cart->id)
            ->where('artwork_id', $artwork->id)
            ->exists();

        if ($exists) {
            return back()->with('info', 'Artwork already in cart.');
        }

        CartItem::create([
            'cart_id' => $cart->id,
            'artwork_id' => $artwork->id,
        ]);

        return back()->with('success', 'Artwork added to cart!');
    }

    public function buyNow(Request $request, Artwork $artwork)
    {
        if (!auth()->user()->can('purchase-artwork', $artwork)) {
            return back()->with('error', 'You cannot purchase this artwork.');
        }

        $cart = auth()->user()->cart()->firstOrCreate([
            'user_id' => auth()->id()
        ]);

        $exists = CartItem::where('cart_id', $cart->id)
            ->where('artwork_id', $artwork->id)
            ->exists();

        if (!$exists) {
            CartItem::create([
                'cart_id' => $cart->id,
                'artwork_id' => $artwork->id,
            ]);
        }

        return redirect()->route('checkout.index');
    }

    public function remove($id)
    {
        $cart = auth()->user()->cart;
        
        if ($cart) {
            CartItem::where('cart_id', $cart->id)
                ->where('artwork_id', $id)
                ->delete();
        }

        return back()->with('success', 'Artwork removed from cart.');
    }

    public function clear()
    {
        $cart = auth()->user()->cart;
        
        if ($cart) {
            $cart->items()->delete();
        }

        return back()->with('success', 'Cart cleared.');
    }
}