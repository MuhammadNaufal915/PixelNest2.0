@extends('layouts.app')

@section('title', 'Payment Failed - PixelNest')

@section('content')
<div class="min-h-screen bg-black py-12 flex items-center justify-center">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        {{-- Error Icon --}}
        <div class="mb-8 animate-fade-up">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-red-500/20 rounded-full mb-6">
                <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-white mb-4">Payment Failed</h1>
            <p class="text-xl text-zinc-400 mb-2">Something went wrong with your payment</p>
            <p class="text-zinc-500">Order #{{ $order->order_number }}</p>
        </div>

        {{-- Error Info --}}
        <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8 mb-8 animate-fade-up delay-100">
            <div class="flex items-start gap-4 mb-6">
                <div class="flex-shrink-0 w-10 h-10 bg-red-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="text-left">
                    <h3 class="text-white font-bold mb-2">What Happened?</h3>
                    <p class="text-zinc-400 text-sm">
                        Your payment could not be processed. This might be due to insufficient funds, 
                        an incorrect card number, or a payment method issue. Don't worry, your order is still saved.
                    </p>
                </div>
            </div>

            <div class="pt-6 border-t border-zinc-800">
                <div class="flex justify-between items-center">
                    <span class="text-zinc-400 font-bold">Order Amount</span>
                    <span class="text-2xl font-bold text-white">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="space-y-4 animate-fade-up delay-200">
            <a href="{{ route('user.orders.show', $order) }}" class="block w-full py-5 bg-white text-black text-center rounded-2xl font-bold hover:bg-zinc-200 transition-all duration-300 hover:scale-[1.02] shadow-xl">
                Try Payment Again
            </a>
            <a href="{{ route('home') }}" class="block w-full py-5 bg-zinc-800 text-white text-center rounded-2xl font-bold hover:bg-zinc-700 transition-all duration-300">
                Back to Home
            </a>
            <a href="mailto:support@pixelnest.com" class="text-zinc-500 hover:text-white transition-colors text-sm">
                Need help? Contact Support
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
