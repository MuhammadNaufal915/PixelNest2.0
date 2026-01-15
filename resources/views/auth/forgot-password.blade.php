@extends('layouts.app')

@section('title', 'Forgot Password - PixelNest')

@section('content')
<div class="min-h-screen bg-black flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        {{-- Header --}}
        <div class="text-center mb-8 animate-fade-up">
            <h1 class="text-4xl font-bold text-white mb-2">Forgot Password?</h1>
            <p class="text-zinc-400">No worries, we'll send you reset instructions</p>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-500/10 border border-green-500/50 rounded-2xl animate-fade-up delay-100">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <p class="text-green-500 text-sm">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        {{-- Error Message --}}
        @if(session('error'))
        <div class="mb-6 p-4 bg-red-500/10 border border-red-500/50 rounded-2xl animate-fade-up delay-100">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                <p class="text-red-500 text-sm">{{ session('error') }}</p>
            </div>
        </div>
        @endif

        {{-- Form --}}
        <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8 animate-fade-up delay-200">
            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                {{-- Email Input --}}
                <div>
                    <label for="email" class="block text-sm font-semibold text-white mb-2">Email Address</label>
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        autocomplete="email" 
                        required 
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-xl text-white placeholder-zinc-500 focus:outline-none focus:border-white transition-colors"
                        placeholder="your@email.com"
                    >
                    @error('email')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit Button --}}
                <button 
                    type="submit" 
                    class="w-full py-4 bg-white text-black rounded-xl font-bold hover:bg-zinc-200 transition-all duration-300 hover:scale-[1.02]"
                >
                    Send Reset Link
                </button>

                {{-- Back to Login --}}
                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-sm text-zinc-500 hover:text-white transition-colors flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Login
                    </a>
                </div>
            </form>
        </div>

        {{-- Info Box --}}
        <div class="mt-6 p-4 bg-zinc-900/50 border border-zinc-800 rounded-2xl animate-fade-up delay-300">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-zinc-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p class="text-sm text-zinc-400">
                        Enter your email address and we'll send you a link to reset your password. The link will expire in 60 minutes.
                    </p>
                </div>
            </div>
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
        animation: fade-up 0.6s ease-out forwards;
    }
    
    .delay-100 {
        animation-delay: 0.1s;
        opacity: 0;
    }
    
    .delay-200 {
        animation-delay: 0.2s;
        opacity: 0;
    }
    
    .delay-300 {
        animation-delay: 0.3s;
        opacity: 0;
    }
</style>
@endsection
