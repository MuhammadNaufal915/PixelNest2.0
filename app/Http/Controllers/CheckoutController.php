<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = auth()->user()->cart()->with('items.artwork')->first();

        if (!$cart || $cart->items->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $total = $cart->total;

        return view('checkout.index', compact('cart', 'total'));
    }

    public function process(Request $request)
    {
        $cart = auth()->user()->cart()->with('items.artwork')->first();

        if (!$cart || $cart->items->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        DB::beginTransaction();
        try {
            // Calculate total
            $total = $cart->total;

            // Create order
            $order = auth()->user()->orders()->create([
                'total_amount' => $total,
                'status' => 'pending',
                'payment_method' => $request->payment_method ?? 'midtrans',
            ]);

            // Create order items
            foreach ($cart->items as $item) {
                $order->items()->create([
                    'artwork_id' => $item->artwork_id,
                    'price' => $item->artwork->price,
                ]);
            }

            // Clear cart
            $cart->items()->delete();

            DB::commit();

            // Redirect to payment
            return redirect()->route('payment.show', $order);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to create order. Please try again.');
        }
    }
}
