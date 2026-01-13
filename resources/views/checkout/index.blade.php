@extends('layouts.app')

@section('title', 'Checkout - PixelNest')

@section('content')
<div class="min-h-screen bg-black py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-12 flex items-center justify-between animate-fade-up">
            <div>
                <h1 class="text-4xl font-bold text-white mb-2">Checkout</h1>
                <p class="text-zinc-400">Review your selection before entering payment</p>
            </div>
            <a href="{{ route('cart.index') }}" class="text-zinc-500 hover:text-white transition-colors flex items-center gap-2 text-sm font-semibold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Edit Cart
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            {{-- Order Details --}}
            <div class="lg:col-span-2 space-y-8 animate-fade-up delay-100">
                <div class="bg-zinc-900/50 border border-zinc-800 rounded-3xl overflow-hidden">
                    <div class="px-8 py-6 border-b border-zinc-800 bg-zinc-900">
                        <h2 class="text-xl font-bold text-white">Your Selection</h2>
                    </div>
                    <div class="divide-y divide-zinc-800">
                        @foreach($cartItems as $item)
                        <div class="p-8 flex items-center gap-6 group hover:bg-white/5 transition-colors">
                            <div class="w-24 h-24 bg-zinc-800 rounded-2xl overflow-hidden flex-shrink-0 border border-zinc-700">
                                @if($item->image_path)
                                    <img src="/storage/{{ $item->image_path }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-zinc-600">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-zinc-500 text-xs uppercase tracking-widest font-semibold mb-1">{{ $item->category->name }}</div>
                                <h3 class="text-xl font-bold text-white truncate mb-1">{{ $item->title }}</h3>
                                <p class="text-sm text-zinc-400">by {{ $item->user->name }}</p>
                            </div>
                            <div class="text-right">
                                <div class="text-xl font-bold text-white">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Shipping info Mockup (for digital products) --}}
                <div class="bg-zinc-900/50 border border-zinc-800 rounded-3xl p-8">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-white">Instant Delivery</h3>
                            <p class="text-sm text-zinc-500">Your digital files will be available for download immediately after payment</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Summary Sidebar --}}
            <div class="lg:col-span-1">
                <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8 sticky top-24 animate-fade-up delay-200">
                    <h2 class="text-2xl font-bold text-white mb-8">Summary</h2>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between text-zinc-500">
                            <span>Subtotal</span>
                            <span class="text-white">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-zinc-500">
                            <span>Tax</span>
                            <span class="text-white">Rp 0</span>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-zinc-800 mb-8">
                        <div class="flex justify-between items-end">
                            <span class="text-zinc-500 font-bold uppercase tracking-widest text-xs">Total Amount</span>
                            <span class="text-3xl font-bold text-white leading-none">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <a href="{{ route('payment.index') }}" class="block w-full py-5 bg-white text-black text-center rounded-2xl font-bold hover:bg-zinc-200 transition-all duration-300 hover:scale-[1.02] shadow-xl">
                        Proceed to Payment
                    </a>

                    <p class="mt-6 text-[10px] text-zinc-600 text-center uppercase tracking-widest font-semibold">
                        Secure checkout • 256-bit encryption
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection