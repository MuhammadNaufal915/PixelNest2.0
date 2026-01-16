<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class MidtransService
{
    public function __construct()
    {
        // Set Midtrans configuration
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$clientKey = config('services.midtrans.client_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');
    }

    /**
     * Create Snap Token for transaction
     */
    public function createSnapToken($order)
    {
        $params = [
            'transaction_details' => [
                'order_id' => $order->order_number,
                'gross_amount' => (int) $order->total_amount,
            ],
            'customer_details' => [
                'first_name' => $order->user->name,
                'email' => $order->user->email,
            ],
            'item_details' => $this->getItemDetails($order),
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return $snapToken;
        } catch (\Exception $e) {
            throw new \Exception('Failed to create Snap token: ' . $e->getMessage());
        }
    }

    /**
     * Get item details from order
     */
    private function getItemDetails($order)
    {
        $items = [];
        foreach ($order->items as $item) {
            $items[] = [
                'id' => $item->artwork_id,
                'price' => (int) $item->price,
                'quantity' => 1,
                'name' => $item->artwork->title,
            ];
        }
        return $items;
    }

    /**
     * Handle notification from Midtrans
     */
    public function handleNotification()
    {
        try {
            $notification = new Notification();
            
            $transactionStatus = $notification->transaction_status;
            $fraudStatus = $notification->fraud_status;
            $orderId = $notification->order_id;
            
            return [
                'order_id' => $orderId,
                'transaction_id' => $notification->transaction_id,
                'transaction_status' => $transactionStatus,
                'fraud_status' => $fraudStatus,
                'payment_type' => $notification->payment_type,
                'raw_response' => json_decode(json_encode($notification), true),
            ];
        } catch (\Exception $e) {
            throw new \Exception('Failed to handle notification: ' . $e->getMessage());
        }
    }

    /**
     * Determine order status based on transaction status
     */
    public function getOrderStatus($transactionStatus, $fraudStatus)
    {
        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'accept') {
                return 'paid';
            }
        } else if ($transactionStatus == 'settlement') {
            return 'paid';
        } else if ($transactionStatus == 'pending') {
            return 'pending';
        } else if ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
            return 'failed';
        }
        
        return 'pending';
    }

    /**
     * Determine payment status based on transaction status
     */
    public function getPaymentStatus($transactionStatus, $fraudStatus)
    {
        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'accept') {
                return 'completed';
            }
        } else if ($transactionStatus == 'settlement') {
            return 'completed';
        } else if ($transactionStatus == 'pending') {
            return 'pending';
        } else if ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
            return 'failed';
        }
        
        return 'pending';
    }
}
