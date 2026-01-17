<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    /**
     * Display payment page
     */
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

        return view('payment.index', compact('total', 'cartItems'));
    }

    /**
     * Process payment - Create order and get Snap token
     */
    public function process(Request $request)
    {
        try {
            DB::beginTransaction();

            $cart = auth()->user()->cart;
            
            if (!$cart || $cart->items->count() === 0) {
                return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
            }

            $cartItems = $cart->items->map(function($item) {
                return $item->artwork;
            });
            $total = $cartItems->sum('price');

            // Create Order with pending status
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'total_amount' => $total,
                'status' => 'pending',
                'payment_method' => null,
            ]);

            // Create Order Items
            foreach ($cartItems as $artwork) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'artwork_id' => $artwork->id,
                    'price' => $artwork->price,
                ]);
            }

            // Get Snap Token from Midtrans
            $snapToken = $this->midtransService->createSnapToken($order);

            // Create Payment record
            $payment = Payment::create([
                'order_id' => $order->id,
                'payment_method' => 'midtrans',
                'transaction_id' => $order->order_number,
                'snap_token' => $snapToken,
                'amount' => $total,
                'status' => 'pending',
            ]);

            // Clear cart
            $cart->items()->delete();

            DB::commit();

            return view('payment.snap', [
                'snapToken' => $snapToken,
                'order' => $order,
                'clientKey' => config('services.midtrans.client_key'),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment process error: ' . $e->getMessage());
            return redirect()->route('payment.index')->with('error', 'Failed to process payment: ' . $e->getMessage());
        }
    }

    /**
     * Handle Midtrans notification/callback
     */
    public function notification(Request $request)
    {
        try {
            $notificationData = $this->midtransService->handleNotification();
            
            // Find order by order_number
            $order = Order::where('order_number', $notificationData['order_id'])->first();
            
            if (!$order) {
                return response()->json(['message' => 'Order not found'], 404);
            }

            // Update payment record
            $payment = $order->payment;
            if ($payment) {
                $payment->update([
                    'transaction_id' => $notificationData['transaction_id'],
                    'payment_method' => $notificationData['payment_type'],
                    'status' => $this->midtransService->getPaymentStatus(
                        $notificationData['transaction_status'], 
                        $notificationData['fraud_status']
                    ),
                    'fraud_status' => $notificationData['fraud_status'],
                    'raw_response' => $notificationData['raw_response'],
                ]);
            }

            // Update order status
            $orderStatus = $this->midtransService->getOrderStatus(
                $notificationData['transaction_status'], 
                $notificationData['fraud_status']
            );
            
            $order->update([
                'status' => $orderStatus,
                'payment_method' => $notificationData['payment_type'],
                'payment_details' => $notificationData['raw_response'],
            ]);

            // If payment is successful, increment download counts
            if ($orderStatus === 'paid') {
                foreach ($order->items as $item) {
                    $item->artwork->increment('downloads_count');
                }
            }

            return response()->json(['message' => 'Notification processed successfully']);

        } catch (\Exception $e) {
            Log::error('Notification error: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to process notification'], 500);
        }
    }

    /**
     * Payment success page
     */
    public function success(Request $request)
    {
        $orderId = $request->query('order_id');
        $order = Order::where('order_number', $orderId)->first();

        if (!$order) {
            return redirect()->route('home')->with('error', 'Order not found');
        }

        return view('payment.success', compact('order'));
    }

    /**
     * Payment pending page
     */
    public function pending(Request $request)
    {
        $orderId = $request->query('order_id');
        $order = Order::where('order_number', $orderId)->first();

        if (!$order) {
            return redirect()->route('home')->with('error', 'Order not found');
        }

        return view('payment.pending', compact('order'));
    }

    /**
     * Payment failed page
     */
    public function failed(Request $request)
    {
        $orderId = $request->query('order_id');
        $order = Order::where('order_number', $orderId)->first();

        if (!$order) {
            return redirect()->route('home')->with('error', 'Order not found');
        }

        return view('payment.failed', compact('order'));
    }
}