@extends('layouts.app')

@section('title', 'About Us - PixelNest')

@section('content')
<div class="min-h-screen bg-black py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Hero Section --}}
        <div class="text-center mb-20 animate-fade-up">
            <h1 class="text-6xl font-bold text-white mb-6">About PixelNest</h1>
            <p class="text-zinc-400 text-xl max-w-3xl mx-auto">
                A premium marketplace connecting digital artists with collectors worldwide
            </p>
        </div>

        {{-- Mission Section --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20">
            <div class="animate-fade-up delay-100">
                <h2 class="text-4xl font-bold text-white mb-6">Our Mission</h2>
                <p class="text-zinc-400 text-lg mb-4">
                    PixelNest was founded with a simple mission: to empower digital artists by providing them with a platform to showcase and monetize their creative work.
                </p>
                <p class="text-zinc-400 text-lg mb-4">
                    We believe that every artist deserves a space where their work can be discovered, appreciated, and fairly compensated. That's why we've built a marketplace that puts artists first.
                </p>
                <p class="text-zinc-400 text-lg">
                    Whether you're a seasoned professional or just starting your creative journey, PixelNest is here to support you every step of the way.
                </p>
            </div>
            <div class="bg-gradient-to-br from-zinc-900 via-zinc-800 to-zinc-900 rounded-2xl border border-zinc-800 p-12 animate-fade-up delay-200">
                <div class="grid grid-cols-2 gap-8 text-center">
                    <div>
                        <div class="text-5xl font-bold text-white mb-2">10K+</div>
                        <div class="text-zinc-400">Artworks</div>
                    </div>
                    <div>
                        <div class="text-5xl font-bold text-white mb-2">5K+</div>
                        <div class="text-zinc-400">Artists</div>
                    </div>
                    <div>
                        <div class="text-5xl font-bold text-white mb-2">50K+</div>
                        <div class="text-zinc-400">Users</div>
                    </div>
                    <div>
                        <div class="text-5xl font-bold text-white mb-2">100+</div>
                        <div class="text-zinc-400">Countries</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Values Section --}}
        <div class="mb-20">
            <h2 class="text-4xl font-bold text-white text-center mb-12">Our Values</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gradient-to-br from-zinc-900 via-zinc-800 to-zinc-900 rounded-2xl border border-zinc-800 p-8 hover:border-zinc-700 hover:shadow-2xl transition-all duration-300 animate-fade-up delay-100">
                    <div class="w-16 h-16 bg-zinc-800 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Community First</h3>
                    <p class="text-zinc-400">
                        We prioritize building a supportive community where artists and collectors can connect, collaborate, and grow together.
                    </p>
                </div>

                <div class="bg-gradient-to-br from-zinc-900 via-zinc-800 to-zinc-900 rounded-2xl border border-zinc-800 p-8 hover:border-zinc-700 hover:shadow-2xl transition-all duration-300 animate-fade-up delay-200">
                    <div class="w-16 h-16 bg-zinc-800 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Trust & Safety</h3>
                    <p class="text-zinc-400">
                        Every artwork is carefully reviewed to ensure quality and authenticity. We protect both artists and buyers with secure transactions.
                    </p>
                </div>

                <div class="bg-gradient-to-br from-zinc-900 via-zinc-800 to-zinc-900 rounded-2xl border border-zinc-800 p-8 hover:border-zinc-700 hover:shadow-2xl transition-all duration-300 animate-fade-up delay-300">
                    <div class="w-16 h-16 bg-zinc-800 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Innovation</h3>
                    <p class="text-zinc-400">
                        We continuously evolve our platform with cutting-edge features to provide the best experience for our community.
                    </p>
                </div>
            </div>
        </div>

        {{-- Team Section --}}
        <div class="mb-20">
            <h2 class="text-4xl font-bold text-white text-center mb-12">Meet Our Team</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center animate-fade-up delay-100">
                    <div class="w-32 h-32 bg-gradient-to-br from-zinc-600 to-zinc-800 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-4xl font-bold">
                        JD
                    </div>
                    <h3 class="text-xl font-bold text-white mb-1">John Doe</h3>
                    <p class="text-zinc-400 text-sm mb-2">CEO & Founder</p>
                    <p class="text-zinc-500 text-xs">Visionary leader with 10+ years in tech</p>
                </div>

                <div class="text-center animate-fade-up delay-200">
                    <div class="w-32 h-32 bg-gradient-to-br from-zinc-600 to-zinc-800 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-4xl font-bold">
                        JS
                    </div>
                    <h3 class="text-xl font-bold text-white mb-1">Jane Smith</h3>
                    <p class="text-zinc-400 text-sm mb-2">Head of Design</p>
                    <p class="text-zinc-500 text-xs">Award-winning designer & artist</p>
                </div>

                <div class="text-center animate-fade-up delay-300">
                    <div class="w-32 h-32 bg-gradient-to-br from-zinc-600 to-zinc-800 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-4xl font-bold">
                        MB
                    </div>
                    <h3 class="text-xl font-bold text-white mb-1">Mike Brown</h3>
                    <p class="text-zinc-400 text-sm mb-2">CTO</p>
                    <p class="text-zinc-500 text-xs">Tech expert & blockchain enthusiast</p>
                </div>

                <div class="text-center animate-fade-up delay-400">
                    <div class="w-32 h-32 bg-gradient-to-br from-zinc-600 to-zinc-800 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-4xl font-bold">
                        SW
                    </div>
                    <h3 class="text-xl font-bold text-white mb-1">Sarah Wilson</h3>
                    <p class="text-zinc-400 text-sm mb-2">Head of Community</p>
                    <p class="text-zinc-500 text-xs">Building connections worldwide</p>
                </div>
            </div>
        </div>

        {{-- CTA Section --}}
        <div class="bg-gradient-to-br from-white via-zinc-100 to-zinc-200 rounded-2xl p-12 text-center animate-fade-up">
            <h2 class="text-4xl font-bold text-black mb-4">Join Our Community</h2>
            <p class="text-zinc-700 text-lg mb-8 max-w-2xl mx-auto">
                Whether you're an artist looking to showcase your work or a collector searching for unique pieces, PixelNest is the perfect place for you.
            </p>
            <div class="flex gap-4 justify-center">
                <a href="{{ route('register') }}" class="px-8 py-4 bg-black text-white rounded-xl font-bold hover:bg-zinc-800 transition-colors duration-200">
                    Get Started
                </a>
                <a href="{{ route('home') }}" class="px-8 py-4 bg-white text-black rounded-xl font-bold hover:bg-zinc-100 transition-colors duration-200 border-2 border-black">
                    Browse Artworks
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
