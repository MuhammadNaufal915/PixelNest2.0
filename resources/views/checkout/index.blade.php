@extends('layouts.app')
@section('title', 'Checkout')
@section('content')
<h1>Checkout</h1>
<div style="max-width:800px;margin:2rem auto;background:#fff;padding:3rem;border-radius:1rem;box-shadow:0 10px 30px rgba(0,0,0,0.1)">
    <h2>Order Summary</h2>
    @foreach($cart->items as $item)
        <div style="display:flex;justify-content:space-between;padding:1rem 0;border-bottom:1px solid var(--gray-light)">
            <div><strong>{{ $item->artwork->title }}</strong><br><small style="color:var(--gray)">by {{ $item->artwork->user->name }}</small></div>
            <span style="font-weight:700">Rp {{ number_format($item->artwork->price, 0, ',', '.') }}</span>
        </div>
    @endforeach
    <div style="display:flex;justify-content:space-between;padding:2rem 0;font-size:1.5rem;font-weight:700">
        <span>Total</span>
        <span style="color:var(--primary)">Rp {{ number_format($total, 0, ',', '.') }}</span>
    </div>
    <form method="POST" action="{{ route('checkout.process') }}">
        @csrf
        <button type="submit" class="btn btn-primary" style="width:100%;padding:1.5rem;font-size:1.2rem">Proceed to Payment</button>
    </form>
</div>
@endsection
