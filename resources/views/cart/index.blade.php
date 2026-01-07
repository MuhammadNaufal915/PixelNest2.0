@extends('layouts.app')
@section('title', 'Shopping Cart')
@section('content')
<h1>Shopping Cart</h1>
@if($cart && $cart->items->count() > 0)
    <div style="display:grid;grid-template-columns:2fr 1fr;gap:2rem;margin-top:2rem">
        <div>
            @foreach($cart->items as $item)
                <div style="background:#fff;padding:1.5rem;border-radius:1rem;margin-bottom:1rem;display:flex;gap:1.5rem;box-shadow:0 2px 4px rgba(0,0,0,0.1)">
                    <img src="{{ $item->artwork->image_url }}" style="width:150px;height:150px;object-fit:cover;border-radius:0.5rem">
                    <div style="flex:1">
                        <h3>{{ $item->artwork->title }}</h3>
                        <p style="color:var(--gray)">by {{ $item->artwork->user->name }}</p>
                        <p style="font-size:1.5rem;font-weight:700;color:var(--primary);margin-top:1rem">Rp {{ number_format($item->artwork->price, 0, ',', '.') }}</p>
                    </div>
                    <form method="POST" action="{{ route('cart.remove', $item) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background:var(--danger);color:#fff;border:none;padding:0.5rem 1rem;border-radius:0.5rem;cursor:pointer">Remove</button>
                    </form>
                </div>
            @endforeach
        </div>
        <div>
            <div style="background:#fff;padding:2rem;border-radius:1rem;box-shadow:0 4px 6px rgba(0,0,0,0.1);position:sticky;top:6rem">
                <h2>Order Summary</h2>
                <div style="margin:2rem 0;padding:2rem 0;border-top:1px solid var(--gray-light);border-bottom:1px solid var(--gray-light)">
                    <div style="display:flex;justify-content:space-between;margin-bottom:1rem">
                        <span>Items ({{ $cart->count }})</span>
                        <span>Rp {{ number_format($cart->total, 0, ',', '.') }}</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;font-size:1.3rem;font-weight:700">
                        <span>Total</span>
                        <span style="color:var(--primary)">Rp {{ number_format($cart->total, 0, ',', '.') }}</span>
                    </div>
                </div>
                <a href="{{ route('checkout.index') }}" class="btn btn-primary" style="width:100%;padding:1rem;text-align:center;display:block">Proceed to Checkout</a>
            </div>
        </div>
    </div>
@else
    <div style="text-align:center;padding:4rem;color:var(--gray)">
        <h2>Your cart is empty</h2>
        <a href="{{ route('home') }}" class="btn btn-primary" style="margin-top:1rem">Browse Artworks</a>
    </div>
@endif
@endsection
