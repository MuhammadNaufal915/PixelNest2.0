@extends('layouts.app')
@section('title', 'My Orders')
@section('content')
<h1>My Orders</h1>
<div style="margin-top:2rem">
    @forelse($orders as $order)
        <div style="background:#fff;padding:2rem;border-radius:1rem;margin-bottom:1.5rem;box-shadow:0 4px 6px rgba(0,0,0,0.1)">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem">
                <div><h3>Order {{ $order->order_number }}</h3><small style="color:var(--gray)">{{ $order->created_at->format('d M Y, H:i') }}</small></div>
                <span class="badge badge-{{ $order->status === 'paid' ? 'success' : ($order->status === 'pending' ? 'warning' : 'danger') }}">{{ ucfirst($order->status) }}</span>
            </div>
            <p><strong>{{ $order->items->count() }} items</strong> - Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
            <a href="{{ route('user.orders.show', $order) }}" class="btn btn-outline" style="margin-top:1rem">View Details</a>
        </div>
    @empty
        <div style="text-align:center;padding:4rem;color:var(--gray)">
            <h2>No orders yet</h2>
            <a href="{{ route('home') }}" class="btn btn-primary" style="margin-top:1rem">Start Shopping</a>
        </div>
    @endforelse
    {{ $orders->links() }}
</div>
@endsection
