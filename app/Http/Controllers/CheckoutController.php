<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = auth()->user()->cart;
        
        if (!$cart || $cart->items->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $cartItems = $cart->items->map(function($item) {
            return $item->artwork;
        });
        $total = $cartItems->sum('price');

        return view('checkout.index', compact('cartItems', 'total'));
    }
}