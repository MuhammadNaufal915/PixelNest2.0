@extends('layouts.app')

@section('title', 'Payment - PixelNest')

@section('content')
<div class="min-h-screen bg-black py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-12 text-center animate-fade-up">
            <h1 class="text-4xl font-bold text-white mb-4">Complete Payment</h1>
            <p class="text-zinc-400">Choose your preferred payment method to secure your purchase</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Payment Options --}}
            <div class="lg:col-span-2 space-y-6">
                <form id="payment-form" method="POST" action="{{ route('payment.process') }}">
                    @csrf
                    <div class="space-y-4 animate-fade-up delay-100 text-zinc-400">
                        {{-- QRIS --}}
                        <label class="relative block group">
                            <input type="radio" name="payment_method" value="qris" class="peer hidden" required onchange="togglePayment('qris')">
                            <div class="p-6 bg-zinc-900 border border-zinc-800 rounded-2xl cursor-pointer transition-all duration-300 group-hover:border-zinc-700 peer-checked:border-white peer-checked:bg-white/5">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-lg font-bold text-white">QRIS</div>
                                        <div class="text-sm text-zinc-500">Scan QR Code from your e-wallet</div>
                                    </div>
                                    <div class="w-6 h-6 border-2 border-zinc-700 rounded-full flex items-center justify-center peer-checked:border-white transition-colors">
                                        <div class="w-3 h-3 bg-white rounded-full scale-0 peer-checked:scale-100 transition-transform duration-300"></div>
                                    </div>
                                </div>
                            </div>
                        </label>

                        {{-- Credit Card --}}
                        <label class="relative block group">
                            <input type="radio" name="payment_method" value="credit_card" class="peer hidden" required onchange="togglePayment('card')">
                            <div class="p-6 bg-zinc-900 border border-zinc-800 rounded-2xl cursor-pointer transition-all duration-300 group-hover:border-zinc-700 peer-checked:border-white peer-checked:bg-white/5">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-lg font-bold text-white">Credit Card</div>
                                        <div class="text-sm text-zinc-500">Pay securely with Visa or Mastercard</div>
                                    </div>
                                    <div class="w-6 h-6 border-2 border-zinc-700 rounded-full flex items-center justify-center peer-checked:border-white transition-colors">
                                        <div class="w-3 h-3 bg-white rounded-full scale-0 peer-checked:scale-100 transition-transform duration-300"></div>
                                    </div>
                                </div>
                            </div>
                        </label>

                        {{-- PayPal --}}
                        <label class="relative block group">
                            <input type="radio" name="payment_method" value="paypal" class="peer hidden" required onchange="togglePayment('paypal')">
                            <div class="p-6 bg-zinc-900 border border-zinc-800 rounded-2xl cursor-pointer transition-all duration-300 group-hover:border-zinc-700 peer-checked:border-white peer-checked:bg-white/5">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20.067 8.178c-.652 4.666-3.703 6.901-7.838 6.901h-1.92l-.934 6.666H6.11l2.493-17.745h6.635c3.31 0 5.432 1.58 4.829 4.178zm-3.804.143c.273-1.956-1.072-3.041-3.132-3.041h-2.915l-1.01 7.21h2.235c2.191 0 4.542-1.066 4.822-4.169z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-lg font-bold text-white">PayPal</div>
                                        <div class="text-sm text-zinc-500">Fast and secure checkout with PayPal</div>
                                    </div>
                                    <div class="w-6 h-6 border-2 border-zinc-700 rounded-full flex items-center justify-center peer-checked:border-white transition-colors">
                                        <div class="w-3 h-3 bg-white rounded-full scale-0 peer-checked:scale-100 transition-transform duration-300"></div>
                                    </div>
                                </div>
                            </div>
                        </label>

                        {{-- Bank Transfer --}}
                        <label class="relative block group">
                            <input type="radio" name="payment_method" value="bank_transfer" class="peer hidden" required onchange="togglePayment('bank')">
                            <div class="p-6 bg-zinc-900 border border-zinc-800 rounded-2xl cursor-pointer transition-all duration-300 group-hover:border-zinc-700 peer-checked:border-white peer-checked:bg-white/5">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-lg font-bold text-white">Bank Transfer</div>
                                        <div class="text-sm text-zinc-500">Direct transfer to our bank account</div>
                                    </div>
                                    <div class="w-6 h-6 border-2 border-zinc-700 rounded-full flex items-center justify-center peer-checked:border-white transition-colors">
                                        <div class="w-3 h-3 bg-white rounded-full scale-0 peer-checked:scale-100 transition-transform duration-300"></div>
                                    </div>
                                </div>
                            </div>
                        </label>

                        {{-- Finalize Button --}}
                        <button type="button" id="submit-btn" onclick="handlePaymentSubmit()" class="w-full px-8 py-5 bg-white text-black rounded-2xl font-bold hover:bg-zinc-200 transition-all duration-300 hover:scale-[1.02] shadow-xl flex items-center justify-center gap-3">
                            Complete Purchase
                            <svg class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            {{-- Summary & QR Display --}}
            <div class="lg:col-span-1 space-y-6">
                {{-- Summary Card --}}
                <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8 animate-fade-up delay-200 overflow-hidden">
                    <h2 class="text-xl font-bold text-white mb-8">Order Summary</h2>
                    <div class="space-y-6">
                        <div class="flex justify-between items-center text-zinc-400">
                            <span class="text-sm uppercase tracking-wider font-semibold">Subtotal</span>
                            <span class="text-white font-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center text-zinc-400">
                            <span class="text-sm uppercase tracking-wider font-semibold">Service Fee</span>
                            <span class="text-white font-bold">Rp 0</span>
                        </div>
                        
                        <div class="pt-8 border-t border-zinc-800">
                            <div class="flex flex-col">
                                <span class="text-zinc-500 text-xs uppercase tracking-widest mb-1">Total Amount</span>
                                <div class="flex items-baseline gap-2">
                                    <span class="text-xl font-bold text-white/50">Rp</span>
                                    <span class="text-4xl font-black text-white leading-none">
                                        {{ number_format($total, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- QR Code Section (Hidden by default) --}}
                    <div id="qris-display" class="hidden animate-fade-up pt-8 mt-8 border-t border-zinc-800 text-center">
                        <div class="mb-6 relative inline-block group">
                            <div class="absolute -inset-1 bg-gradient-to-r from-zinc-600 to-zinc-400 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                            <div class="relative bg-white p-3 rounded-xl shadow-2xl">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&margin=8&data=https://pixelnest2.0/checkout/pay/{{ strtoupper(uniqid()) }}" 
                                     alt="QRIS Code" 
                                     class="w-48 h-48 mx-auto">
                            </div>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm font-black text-white uppercase tracking-tight">Scan QRIS to Pay</p>
                            <p class="text-[9px] text-zinc-500 uppercase tracking-[0.2em] font-bold">Supported E-Wallets & Banks</p>
                        </div>
                    </div>
                </div>

                <div class="bg-zinc-900/50 border border-zinc-800 rounded-2xl p-6 animate-fade-up delay-300">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-white/5 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <div class="text-[11px] text-zinc-500 leading-relaxed">
                            Payment is encrypted and secure. By proceeding, you agree to our <a href="#" class="text-zinc-300 underline underline-offset-4">Terms of Service</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let selectedMethod = '';
let qrisGenerated = false;
let paymentVerified = false;

function togglePayment(method) {
    selectedMethod = method;
    const qrisDisplay = document.getElementById('qris-display');
    const submitBtn = document.getElementById('submit-btn');
    
    // Reset states
    qrisDisplay.classList.add('hidden');
    qrisGenerated = false;
    paymentVerified = false;

    if (method === 'qris') {
        submitBtn.innerHTML = `
            Generate QR Code
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
            </svg>
        `;
    } else {
        submitBtn.innerHTML = `
            Complete Purchase
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
        `;
    }
}

async function handlePaymentSubmit() {
    const form = document.getElementById('payment-form');
    const qrisDisplay = document.getElementById('qris-display');
    const submitBtn = document.getElementById('submit-btn');

    if (!selectedMethod) {
        showError('Please select a payment method');
        return;
    }

    if (selectedMethod === 'qris') {
        if (!qrisGenerated) {
            // Step 1: Generate QR
            qrisDisplay.classList.remove('hidden');
            qrisGenerated = true;
            submitBtn.innerHTML = `
                Verify Payment Status
                <svg class="w-5 h-5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            `;
            return;
        }

        if (!paymentVerified) {
            // Step 2: Simulate Payment Verification
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                Checking Payment...
                <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            `;

            // Simulate a Delay (2 seconds)
            await new Promise(resolve => setTimeout(resolve, 2000));

            // Randomly decide if paid or not (Simulated)
            const isPaid = Math.random() > 0.5; 

            if (!isPaid) {
                showError('Payment not detected. Please scan and pay first.');
                submitBtn.disabled = false;
                submitBtn.innerHTML = `
                    Verify Payment Status
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                `;
                return;
            }

            // Payment Detected
            paymentVerified = true;
            submitBtn.disabled = false;
            submitBtn.classList.remove('bg-white', 'text-black');
            submitBtn.classList.add('bg-green-600', 'text-white');
            submitBtn.innerHTML = `
                Payment Detected! Confirm Now
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            `;
            return;
        }
    }

    // Final Step: Submit Form
    form.submit();
}

function showError(message) {
    // Create temporary toast error
    const toast = document.createElement('div');
    toast.className = 'fixed top-4 right-4 bg-red-600 text-white px-6 py-4 rounded-2xl shadow-2xl z-50 animate-fade-in flex items-center gap-3 border border-red-500';
    toast.innerHTML = `
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span class="font-bold">${message}</span>
    `;
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.classList.add('animate-fade-out');
        setTimeout(() => toast.remove(), 500);
    }, 3000);
}
</script>
@endsection