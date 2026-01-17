<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(15);

        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');

        return view('admin.orders.index', compact('orders', 'totalOrders', 'totalRevenue'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.artwork.user', 'payment']);
        return view('admin.orders.show', compact('order'));
    }

    public function export()
    {
        $orders = Order::with('user', 'items')->latest()->get();
        $filename = "orders-" . date('Y-m-d') . ".csv";

        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=\"$filename\"",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['Order ID', 'Date', 'Customer Name', 'Customer Email', 'Items Count', 'Total Amount', 'Status'];

        $callback = function () use ($orders, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($orders as $order) {
                fputcsv($file, [
                    $order->order_number,
                    $order->created_at->format('Y-m-d H:i:s'),
                    $order->user ? $order->user->name : 'N/A',
                    $order->user ? $order->user->email : 'N/A',
                    $order->items->count(),
                    $order->total_amount,
                    $order->status
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}