@extends('layouts.app')
@section('title', 'Manage Orders')
@section('content')
<h1>Manage Orders</h1>
<div style="margin:2rem 0;display:flex;gap:1rem">
    <a href="{{ route('admin.orders.index') }}" class="btn {{ !request('status') ? 'btn-primary' : 'btn-outline' }}">All</a>
    <a href="{{ route('admin.orders.index', ['status'=>'pending']) }}" class="btn {{ request('status')=='pending' ? 'btn-primary' : 'btn-outline' }}">Pending</a>
    <a href="{{ route('admin.orders.index', ['status'=>'paid']) }}" class="btn {{ request('status')=='paid' ? 'btn-primary' : 'btn-outline' }}">Paid</a>
    <a href="{{ route('admin.orders.index', ['status'=>'failed']) }}" class="btn {{ request('status')=='failed' ? 'btn-primary' : 'btn-outline' }}">Failed</a>
</div>
<div style="background:#fff;border-radius:1rem;padding:2rem;box-shadow:0 4px 6px rgba(0,0,0,0.1)">
    <table class="table">
        <thead><tr><th>Order Number</th><th>Customer</th><th>Items</th><th>Total</th><th>Status</th><th>Date</th><th>Action</th></tr></thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td><strong>{{ $order->order_number }}</strong></td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->items->count() }} items</td>
                    <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td><span class="badge badge-{{ $order->status === 'paid' ? 'success' : ($order->status === 'pending' ? 'warning' : 'danger') }}">{{ ucfirst($order->status) }}</span></td>
                    <td>{{ $order->created_at->format('d M Y') }}</td>
                    <td><a href="{{ route('admin.orders.show', $order) }}" class="btn btn-outline" style="padding:0.5rem 1rem">View</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $orders->links() }}
</div>
@endsection
