@extends('layouts.app')

@section('title', 'Shopping Cart - PixelNest')

@section('content')
<div class="min-h-screen bg-black py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold mb-8 text-white animate-fade-in">Shopping Cart</h1>

        @if(isset($cartItems) && $cartItems->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Cart Items --}}
                <div class="lg:col-span-2 space-y-4 animate-slide-up">
                    @foreach($cartItems as $item)
                        <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-6 card-hover">
                            <div class="flex flex-col sm:flex-row gap-6">
                                {{-- Image --}}
                                <div class="w-full sm:w-32 h-32 bg-gradient-to-br from-zinc-700 via-zinc-800 to-black rounded-lg overflow-hidden flex-shrink-0">
                                    @if($item->image_path)
                                        <img src="/storage/{{ $item->image_path }}" 
                                             alt="{{ $item->title }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-12 h-12 text-zinc-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                {{-- Info --}}
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-lg mb-2 text-white truncate">{{ $item->title }}</h3>
                                    <p class="text-zinc-400 text-sm mb-4">by {{ $item->user->name ?? 'Unknown' }}</p>
                                    <p class="text-2xl font-bold text-white">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>

                                {{-- Remove Button --}}
                                <div class="flex items-start">
                                    <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-zinc-400 hover:text-red-400 hover:bg-red-900/20 rounded-lg transition-all duration-200">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Summary --}}
                <div class="lg:col-span-1 animate-slide-up">
                    <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-6 sticky top-24">
                        <h2 class="text-xl font-bold mb-6 text-white">Order Summary</h2>
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between text-zinc-400">
                                <span>Items ({{ $cartItems->count() }})</span>
                                <span>Rp {{ number_format($total ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="border-t border-zinc-800 pt-4 flex justify-between">
                                <span class="text-xl font-bold text-white">Total</span>
                                <span class="text-2xl font-bold text-white">Rp {{ number_format($total ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="block w-full btn-primary text-center mb-3">
                            Proceed to Checkout
                        </a>

                        <form method="POST" action="{{ route('cart.clear') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-6 py-3 bg-red-900/20 text-red-400 border border-red-900/50 rounded-lg font-semibold hover:bg-red-900/30 hover:border-red-800 transition-all duration-200">
                                Clear Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-16 animate-scale-in">
                <div class="inline-block p-12 bg-zinc-900 rounded-2xl border border-zinc-800">
                    <svg class="w-24 h-24 text-zinc-600 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <h3 class="text-2xl font-bold text-white mb-4">Your cart is empty</h3>
                    <p class="text-zinc-400 mb-8">Start adding artworks to your cart!</p>
                    <a href="{{ route('home') }}" class="inline-block btn-primary">
                        Continue Shopping
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection