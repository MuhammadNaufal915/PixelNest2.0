@extends('layouts.app')

@section('title', 'Payment - PixelNest')

@section('content')
<div class="min-h-screen bg-black py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-12 text-center animate-fade-up">
            <h1 class="text-4xl font-bold text-white mb-2">Complete Your Payment</h1>
            <p class="text-zinc-400">Order #{{ $order->order_number }}</p>
        </div>

        {{-- Payment Container --}}
        <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8 animate-fade-up delay-100">
            <div class="text-center mb-8">
                <div class="inline-block p-4 bg-white/10 rounded-2xl mb-4">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-white mb-2">Total Amount</h2>
                <p class="text-4xl font-bold text-white">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
            </div>

            {{-- Payment Button --}}
            <div id="snap-container" class="mb-6"></div>
            <button id="pay-button" class="w-full py-5 bg-white text-black text-center rounded-2xl font-bold hover:bg-zinc-200 transition-all duration-300 hover:scale-[1.02] shadow-xl">
                Pay Now
            </button>

            <p class="mt-6 text-xs text-zinc-600 text-center uppercase tracking-widest font-semibold">
                Powered by Midtrans • Secure Payment
            </p>
        </div>

        {{-- Order Summary --}}
        <div class="mt-8 bg-zinc-900/50 border border-zinc-800 rounded-3xl p-8 animate-fade-up delay-200">
            <h3 class="text-xl font-bold text-white mb-6">Order Summary</h3>
            <div class="space-y-4">
                @foreach($order->items as $item)
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-zinc-800 rounded-xl overflow-hidden">
                            @if($item->artwork->image_path)
                                <img src="/storage/{{ $item->artwork->image_path }}" alt="{{ $item->artwork->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-zinc-600">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h4 class="text-white font-semibold">{{ $item->artwork->title }}</h4>
                            <p class="text-sm text-zinc-500">{{ $item->artwork->category->name }}</p>
                        </div>
                    </div>
                    <span class="text-white font-bold">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- Midtrans Snap Script --}}
@if(config('services.midtrans.is_production'))
    <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ $clientKey }}"></script>
@else
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ $clientKey }}"></script>
@endif
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                window.location.href = "{{ route('payment.success') }}?order_id={{ $order->order_number }}";
            },
            onPending: function(result){
                window.location.href = "{{ route('payment.pending') }}?order_id={{ $order->order_number }}";
            },
            onError: function(result){
                window.location.href = "{{ route('payment.failed') }}?order_id={{ $order->order_number }}";
            },
            onClose: function(){
                alert('You closed the popup without finishing the payment');
            }
        });
    };
</script>

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
