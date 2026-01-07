<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set Midtrans configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function show(Order $order)
    {
        // Check ownership
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Check if already paid
        if ($order->isPaid()) {
            return redirect()->route('user.orders.show', $order)
                ->with('info', 'This order has already been paid.');
        }

        // Prepare transaction details
        $params = [
            'transaction_details' => [
                'order_id' => $order->order_number,
                'gross_amount' => (int) $order->total_amount,
            ],
            'customer_details' => [
                'first_name' => $order->user->name,
                'email' => $order->user->email,
            ],
            'item_details' => $order->items->map(function($item) {
                return [
                    'id' => $item->artwork_id,
                    'price' => (int) $item->price,
                    'quantity' => 1,
                    'name' => $item->artwork->title,
                ];
            })->toArray(),
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return view('payment.index', compact('order', 'snapToken'));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to initiate payment: ' . $e->getMessage());
        }
    }

    public function callback(Request $request)
    {
        try {
            $notification = new Notification();

            $transactionStatus = $notification->transaction_status;
            $orderNumber = $notification->order_id;
            $fraudStatus = $notification->fraud_status;

            $order = Order::where('order_number', $orderNumber)->firstOrFail();

            $paymentDetails = [
                'transaction_id' => $notification->transaction_id,
                'transaction_status' => $transactionStatus,
                'payment_type' => $notification->payment_type,
                'transaction_time' => $notification->transaction_time,
            ];

            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'accept') {
                    $order->markAsPaid($paymentDetails);
                }
            } elseif ($transactionStatus == 'settlement') {
                $order->markAsPaid($paymentDetails);
            } elseif ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
                $order->markAsFailed($paymentDetails);
            } elseif ($transactionStatus == 'pending') {
                $order->update(['payment_details' => $paymentDetails]);
            }

            return response()->json(['status' => 'success']);

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function finish(Request $request)
    {
        $orderNumber = $request->order_id;
        $order = Order::where('order_number', $orderNumber)->first();

        if ($order && $order->user_id === auth()->id()) {
            return redirect()->route('user.orders.show', $order)
                ->with('success', 'Payment completed! Check your order status.');
        }

        return redirect()->route('user.orders.index')
            ->with('info', 'Payment process completed.');
    }
}
