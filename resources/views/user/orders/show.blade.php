@extends('layouts.app')
@section('title', 'Order Details')
@section('content')
<h1>Order Details</h1>
<div style="background:#fff;padding:3rem;border-radius:1rem;margin-top:2rem;box-shadow:0 10px 30px rgba(0,0,0,0.1)">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;padding-bottom:2rem;border-bottom:2px solid var(--gray-light)">
        <div><h2>{{ $order->order_number }}</h2><p style="color:var(--gray)">{{ $order->created_at->format('d M Y, H:i') }}</p></div>
        <span class="badge badge-{{ $order->status === 'paid' ? 'success' : ($order->status === 'pending' ? 'warning' : 'danger') }}" style="font-size:1rem;padding:0.5rem 1.5rem">{{ ucfirst($order->status) }}</span>
    </div>
    @foreach($order->items as $item)
        <div style="display:flex;gap:1.5rem;padding:1.5rem 0;border-bottom:1px solid var(--gray-light)">
            <img src="{{ $item->artwork->image_url }}" style="width:120px;height:120px;object-fit:cover;border-radius:0.5rem">
            <div style="flex:1">
                <h3>{{ $item->artwork->title }}</h3>
                <p style="color:var(--gray)">by {{ $item->artwork->user->name }}</p>
                <p style="color:var(--primary);font-weight:700;font-size:1.2rem;margin-top:1rem">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                @if($order->isPaid())
                    <a href="{{ route('user.orders.download', [$order, $item->artwork_id]) }}" class="btn btn-primary" style="margin-top:1rem">Download File</a>
                @endif
            </div>
        </div>
    @endforeach
    <div style="display:flex;justify-content:space-between;align-items:center;padding-top:2rem;font-size:1.5rem;font-weight:700">
        <span>Total</span>
        <span style="color:var(--primary)">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
    </div>
</div>
@endsection
