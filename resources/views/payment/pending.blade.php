@extends('layouts.app')

@section('title', 'Payment Pending - PixelNest')

@section('content')
<div class="min-h-screen bg-black py-12 flex items-center justify-center">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        {{-- Pending Icon --}}
        <div class="mb-8 animate-fade-up">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-yellow-500/20 rounded-full mb-6">
                <svg class="w-12 h-12 text-yellow-500 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-white mb-4">Payment Pending</h1>
            <p class="text-xl text-zinc-400 mb-2">We're waiting for your payment</p>
            <p class="text-zinc-500">Order #{{ $order->order_number }}</p>
        </div>

        {{-- Info Box --}}
        <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8 mb-8 animate-fade-up delay-100">
            <div class="flex items-start gap-4 mb-6">
                <div class="flex-shrink-0 w-10 h-10 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="text-left">
                    <h3 class="text-white font-bold mb-2">What's Next?</h3>
                    <p class="text-zinc-400 text-sm">
                        Your order has been created and is waiting for payment confirmation. 
                        Please complete the payment process. Once confirmed, you'll be able to download your artworks.
                    </p>
                </div>
            </div>

            <div class="pt-6 border-t border-zinc-800">
                <div class="flex justify-between items-center">
                    <span class="text-zinc-400 font-bold">Amount Due</span>
                    <span class="text-2xl font-bold text-white">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="space-y-4 animate-fade-up delay-200">
            <a href="{{ route('user.orders.show', $order) }}" class="block w-full py-5 bg-white text-black text-center rounded-2xl font-bold hover:bg-zinc-200 transition-all duration-300 hover:scale-[1.02] shadow-xl">
                View Order Status
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
    
    @keyframes spin-slow {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }
    
    .animate-fade-up {
        animation: fade-up 0.6s ease-out;
    }
    
    .animate-spin-slow {
        animation: spin-slow 3s linear infinite;
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
