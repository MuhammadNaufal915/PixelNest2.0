@extends('layouts.app')

@section('title', 'Pricing - PixelNest')

@section('content')
<div class="min-h-screen bg-black py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-16 animate-fade-up">
            <h1 class="text-5xl font-bold text-white mb-4">Simple, Transparent Pricing</h1>
            <p class="text-zinc-400 text-lg">Choose the plan that works best for you</p>
        </div>

        {{-- Pricing Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            {{-- Free Plan --}}
            <div class="bg-gradient-to-br from-zinc-900 via-zinc-800 to-zinc-900 rounded-2xl border border-zinc-800 p-8 hover:border-zinc-700 hover:shadow-2xl transition-all duration-300 animate-fade-up delay-100">
                <div class="text-center mb-6">
                    <h3 class="text-2xl font-bold text-white mb-2">Free</h3>
                    <div class="flex items-baseline justify-center gap-2">
                        <span class="text-5xl font-bold text-white">Rp 0</span>
                        <span class="text-zinc-500">/month</span>
                    </div>
                </div>
                
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start gap-3 text-zinc-300">
                        <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Browse all artworks</span>
                    </li>
                    <li class="flex items-start gap-3 text-zinc-300">
                        <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Upload up to 5 artworks</span>
                    </li>
                    <li class="flex items-start gap-3 text-zinc-300">
                        <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Basic support</span>
                    </li>
                    <li class="flex items-start gap-3 text-zinc-500">
                        <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <span>15% commission</span>
                    </li>
                </ul>
                
                <button class="w-full px-6 py-3 bg-zinc-800 text-white rounded-xl font-bold hover:bg-zinc-700 transition-colors duration-200 border border-zinc-700">
                    Get Started
                </button>
            </div>

            {{-- Pro Plan --}}
            <div class="bg-gradient-to-br from-white via-zinc-100 to-zinc-200 rounded-2xl border-2 border-white p-8 hover:shadow-2xl transition-all duration-300 transform scale-105 animate-fade-up delay-200">
                <div class="absolute -top-4 left-1/2 -translate-x-1/2">
                    <span class="px-4 py-1 bg-black text-white text-sm font-bold rounded-full">POPULAR</span>
                </div>
                
                <div class="text-center mb-6">
                    <h3 class="text-2xl font-bold text-black mb-2">Pro</h3>
                    <div class="flex items-baseline justify-center gap-2">
                        <span class="text-5xl font-bold text-black">Rp 99K</span>
                        <span class="text-zinc-600">/month</span>
                    </div>
                </div>
                
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start gap-3 text-black">
                        <svg class="w-5 h-5 text-black mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Everything in Free</span>
                    </li>
                    <li class="flex items-start gap-3 text-black">
                        <svg class="w-5 h-5 text-black mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Unlimited artworks</span>
                    </li>
                    <li class="flex items-start gap-3 text-black">
                        <svg class="w-5 h-5 text-black mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Priority support</span>
                    </li>
                    <li class="flex items-start gap-3 text-black">
                        <svg class="w-5 h-5 text-black mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>10% commission</span>
                    </li>
                    <li class="flex items-start gap-3 text-black">
                        <svg class="w-5 h-5 text-black mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Featured placement</span>
                    </li>
                </ul>
                
                <button class="w-full px-6 py-3 bg-black text-white rounded-xl font-bold hover:bg-zinc-800 transition-colors duration-200">
                    Upgrade Now
                </button>
            </div>

            {{-- Enterprise Plan --}}
            <div class="bg-gradient-to-br from-zinc-900 via-zinc-800 to-zinc-900 rounded-2xl border border-zinc-800 p-8 hover:border-zinc-700 hover:shadow-2xl transition-all duration-300 animate-fade-up delay-300">
                <div class="text-center mb-6">
                    <h3 class="text-2xl font-bold text-white mb-2">Enterprise</h3>
                    <div class="flex items-baseline justify-center gap-2">
                        <span class="text-5xl font-bold text-white">Custom</span>
                    </div>
                </div>
                
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start gap-3 text-zinc-300">
                        <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Everything in Pro</span>
                    </li>
                    <li class="flex items-start gap-3 text-zinc-300">
                        <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Dedicated account manager</span>
                    </li>
                    <li class="flex items-start gap-3 text-zinc-300">
                        <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Custom commission rate</span>
                    </li>
                    <li class="flex items-start gap-3 text-zinc-300">
                        <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>API access</span>
                    </li>
                    <li class="flex items-start gap-3 text-zinc-300">
                        <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>White-label options</span>
                    </li>
                </ul>
                
                <button class="w-full px-6 py-3 bg-white text-black rounded-xl font-bold hover:bg-zinc-200 transition-colors duration-200">
                    Contact Sales
                </button>
            </div>
        </div>

        {{-- FAQ Section --}}
        <div class="mt-20 max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold text-white text-center mb-12">Frequently Asked Questions</h2>
            
            <div class="space-y-4">
                <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-6">
                    <h3 class="text-lg font-bold text-white mb-2">Can I change my plan later?</h3>
                    <p class="text-zinc-400">Yes, you can upgrade or downgrade your plan at any time. Changes will be reflected in your next billing cycle.</p>
                </div>
                
                <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-6">
                    <h3 class="text-lg font-bold text-white mb-2">What payment methods do you accept?</h3>
                    <p class="text-zinc-400">We accept all major credit cards, debit cards, and bank transfers for Indonesian users.</p>
                </div>
                
                <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-6">
                    <h3 class="text-lg font-bold text-white mb-2">Is there a refund policy?</h3>
                    <p class="text-zinc-400">Yes, we offer a 30-day money-back guarantee if you're not satisfied with our service.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
