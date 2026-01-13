@extends('layouts.app')

@section('title', 'Order Details - PixelNest')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">Order Details</h1>
        <a href="{{ route('user.orders.index') }}" class="text-indigo-600 hover:underline">← Back to Orders</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Order Information</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <div class="text-gray-600 text-sm">Order Number</div>
                        <div class="font-medium">{{ $order->order_number }}</div>
                    </div>
                    <div>
                        <div class="text-gray-600 text-sm">Order Date</div>
                        <div class="font-medium">{{ $order->created_at->format('M d, Y H:i') }}</div>
                    </div>
                    <div>
                        <div class="text-gray-600 text-sm">Status</div>
                        <div>
                            <span class="px-3 py-1 rounded-full text-sm
                                @if($order->status === 'completed') bg-green-100 text-green-800
                                @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                    <div>
                        <div class="text-gray-600 text-sm">Payment Method</div>
                        <div class="font-medium">{{ ucfirst(str_replace('_', ' ', $order->payment->payment_method)) }}</div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Purchased Items</h2>
                <div class="space-y-4">
                    @foreach($order->items as $item)
                        <div class="flex items-center justify-between border-b pb-4">
                            <div class="flex items-center flex-1">
                                <img src="{{ asset('storage/' . $item->artwork->image_path) }}" alt="{{ $item->artwork->title }}" class="w-20 h-20 object-cover rounded mr-4">
                                <div>
                                    <div class="font-medium">{{ $item->artwork->title }}</div>
                                    <div class="text-sm text-gray-600">by {{ $item->artwork->user->name }}</div>
                                    @if($order->status === 'completed')
                                        <a href="{{ asset('storage/' . $item->artwork->file_path) }}" download class="text-indigo-600 hover:underline text-sm mt-1 inline-block">
                                            Download File
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="font-bold text-indigo-600">${{ number_format($item->price, 2) }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div>
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-8">
                <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-medium">${{ number_format($order->total_amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between border-t pt-3">
                        <span class="font-semibold">Total</span>
                        <span class="text-2xl font-bold text-indigo-600">${{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>

                @if($order->status === 'completed')
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
                        <p class="text-green-800 font-medium">Order Completed</p>
                        <p class="text-green-600 text-sm mt-1">You can download your files above</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection