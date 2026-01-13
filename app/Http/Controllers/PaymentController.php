<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class PaymentController extends Controller
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

        return view('payment.index', compact('total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:credit_card,paypal,bank_transfer,qris',
        ]);

        $cart = auth()->user()->cart;
        
        if (!$cart || $cart->items->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $cartItems = $cart->items->map(function($item) {
            return $item->artwork;
        });
        $total = $cartItems->sum('price');

        // Create Order
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'total_amount' => $total,
            'status' => 'paid',
            'payment_method' => $request->payment_method,
            'payment_details' => [
                'transaction_id' => 'TXN-' . strtoupper(uniqid()),
                'payment_date' => now()->toDateTimeString(),
            ],
        ]);

        // Create Order Items
        foreach ($cartItems as $artwork) {
            OrderItem::create([
                'order_id' => $order->id,
                'artwork_id' => $artwork->id,
                'price' => $artwork->price,
            ]);

            // Increment downloads
            $artwork->increment('downloads_count');
        }

        // Clear cart
        $cart->items()->delete();

        return redirect()->route('user.orders.show', $order)->with('success', 'Payment successful! You can now download your artworks.');
    }
}