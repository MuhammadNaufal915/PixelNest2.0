@extends('layouts.app')

@section('title', 'Payment Successful - PixelNest')

@section('content')
<div class="min-h-screen bg-black py-12 flex items-center justify-center">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        {{-- Success Icon --}}
        <div class="mb-8 animate-fade-up">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-green-500/20 rounded-full mb-6">
                <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-white mb-4">Payment Successful!</h1>
            <p class="text-xl text-zinc-400 mb-2">Thank you for your purchase</p>
            <p class="text-zinc-500">Order #{{ $order->order_number }}</p>
        </div>

        {{-- Order Details --}}
        <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8 mb-8 animate-fade-up delay-100">
            <h2 class="text-2xl font-bold text-white mb-6">Order Details</h2>
            <div class="space-y-4 mb-6">
                @foreach($order->items as $item)
                <div class="flex justify-between items-center text-left">
                    <div>
                        <h3 class="text-white font-semibold">{{ $item->artwork->title }}</h3>
                        <p class="text-sm text-zinc-500">{{ $item->artwork->category->name }}</p>
                    </div>
                    <span class="text-white font-bold">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                </div>
                @endforeach
            </div>
            <div class="pt-6 border-t border-zinc-800">
                <div class="flex justify-between items-center">
                    <span class="text-zinc-400 font-bold">Total Paid</span>
                    <span class="text-2xl font-bold text-white">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="space-y-4 animate-fade-up delay-200">
            <a href="{{ route('user.orders.show', $order) }}" class="block w-full py-5 bg-white text-black text-center rounded-2xl font-bold hover:bg-zinc-200 transition-all duration-300 hover:scale-[1.02] shadow-xl">
                View Order & Download
            </a>
            <a href="{{ route('home') }}" class="block w-full py-5 bg-zinc-800 text-white text-center rounded-2xl font-bold hover:bg-zinc-700 transition-all duration-300">
                Back to Home
            </a>
        </div>
    </div>
</div>

<style>
    @keyframes fade-up {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-up {
        animation: fade-up 0.6s ease-out;
    }
    
    .delay-100 {
        animation-delay: 0.1s;
        opacity: 0;
        animation-fill-mode: forwards;
    }
    
    .delay-200 {
        animation-delay: 0.2s;
        opacity: 0;
        animation-fill-mode: forwards;
    }
</style>
@endsection
