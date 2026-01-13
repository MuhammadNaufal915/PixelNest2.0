@extends('layouts.app')

@section('title', 'PixelNest - Premium Digital Artwork Marketplace')

@section('content')
<div class="bg-black">
    {{-- Hero Section --}}
    <section class="relative min-h-[90vh] flex items-center justify-center overflow-hidden">
        {{-- Animated Background --}}
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-20 left-10 w-72 h-72 bg-white/5 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-white/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 0.7s;"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-white/3 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                {{-- Left Content --}}
                <div class="text-left animate-fade-up space-y-8">
                    <div class="inline-block px-4 py-2 bg-zinc-900 border border-zinc-800 rounded-full">
                        <span class="text-zinc-400 text-sm font-medium">🎨 PREMIUM DIGITAL MARKETPLACE</span>
                    </div>
                    
                    <div class="space-y-6">
                        <h1 class="text-6xl lg:text-7xl font-bold text-white leading-tight">
                            Discover Amazing
                            <span class="block mt-2 bg-gradient-to-r from-white via-zinc-300 to-zinc-500 bg-clip-text text-transparent">
                                Digital Artworks
                            </span>
                        </h1>
                        
                        <p class="text-xl text-zinc-400 max-w-xl leading-relaxed">
                            Explore thousands of premium digital artworks from talented creators worldwide. Find the perfect piece for your next project.
                        </p>
                    </div>
                    
                    <div class="flex flex-wrap gap-4 pt-4">
                        <a href="{{ route('categories.index') }}" class="px-8 py-4 bg-white text-black rounded-xl font-bold hover:bg-zinc-200 transition-all duration-200 hover:scale-105 shadow-lg shadow-white/10">
                            Explore Artworks
                        </a>
                        <a href="{{ route('about') }}" class="px-8 py-4 bg-zinc-900 text-white rounded-xl font-bold border border-zinc-800 hover:border-zinc-700 hover:bg-zinc-800 transition-all duration-200">
                            Learn More
                        </a>
                    </div>

                    {{-- Stats --}}
                    <div class="grid grid-cols-3 gap-8 pt-12 border-t border-zinc-800/50">
                        <div class="space-y-1">
                            <div class="text-4xl font-bold text-white">{{ $artworks->count() }}+</div>
                            <div class="text-sm text-zinc-500 font-medium">Artworks</div>
                        </div>
                        <div class="space-y-1">
                            <div class="text-4xl font-bold text-white">{{ $categories->count() }}+</div>
                            <div class="text-sm text-zinc-500 font-medium">Categories</div>
                        </div>
                        <div class="space-y-1">
                            <div class="text-4xl font-bold text-white">1K+</div>
                            <div class="text-sm text-zinc-500 font-medium">Artists</div>
                        </div>
                    </div>
                </div>

                {{-- Right Visual --}}
                <div class="relative animate-fade-up" style="animation-delay: 0.2s;">
                    <div class="relative">
                        {{-- Main Card --}}
                        <div class="bg-gradient-to-br from-zinc-900 via-zinc-800 to-zinc-900 rounded-3xl p-8 border border-zinc-800 shadow-2xl shadow-black/50">
                            <div class="aspect-square bg-zinc-800 rounded-2xl mb-6 overflow-hidden group">
                                <div class="w-full h-full bg-gradient-to-br from-zinc-700 via-zinc-800 to-zinc-900 flex items-center justify-center group-hover:scale-105 transition-transform duration-500">
                                    <svg class="w-32 h-32 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <h3 class="text-2xl font-bold text-white mb-2">Featured Artwork</h3>
                                    <p class="text-zinc-400 text-sm">Premium quality digital art</p>
                                </div>
                                <div class="flex items-center justify-between pt-4 border-t border-zinc-700">
                                    <span class="text-3xl font-bold text-white">Rp 500K</span>
                                    <button class="px-6 py-3 bg-white text-black rounded-xl font-semibold text-sm hover:bg-zinc-200 transition-colors">
                                        View Details
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Floating Stats Card --}}
                        <div class="absolute -bottom-8 -left-8 bg-zinc-900/90 backdrop-blur-lg border border-zinc-800 rounded-2xl p-5 shadow-xl">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-zinc-800 rounded-xl flex items-center justify-center">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-base font-bold text-white">+24% This Week</div>
                                    <div class="text-sm text-zinc-500">New Uploads</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Categories Section --}}
    <section class="py-20 bg-gradient-to-b from-black to-zinc-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-up">
                <div class="inline-block px-4 py-2 bg-zinc-900 border border-zinc-800 rounded-full mb-4">
                    <span class="text-zinc-400 text-sm">EXPLORE CATEGORIES</span>
                </div>
                <h2 class="text-5xl font-bold text-white mb-4">Browse by Category</h2>
                <p class="text-zinc-400 text-lg max-w-2xl mx-auto">
                    Find exactly what you're looking for across our diverse range of digital art categories
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($categories->take(8) as $index => $category)
                    <a href="{{ route('categories.show', $category->id) }}" 
                       class="group animate-fade-up"
                       style="animation-delay: {{ $index * 0.1 }}s">
                        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 hover:border-zinc-700 hover:bg-zinc-800 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl">
                            <div class="w-14 h-14 bg-zinc-800 rounded-xl flex items-center justify-center mb-4 group-hover:bg-zinc-700 transition-colors duration-300">
                                <svg class="w-7 h-7 text-zinc-400 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-white mb-1 group-hover:text-zinc-100 transition-colors">
                                {{ $category->name }}
                            </h3>
                            <p class="text-zinc-500 text-sm">{{ $category->artworks_count ?? 0 }} items</p>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-zinc-900 text-white rounded-xl font-semibold border border-zinc-800 hover:border-zinc-700 hover:bg-zinc-800 transition-all duration-200">
                    View All Categories
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- Featured Artworks Section --}}
    <section class="py-20 bg-zinc-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-12 animate-fade-up">
                <div>
                    <div class="inline-block px-4 py-2 bg-zinc-900 border border-zinc-800 rounded-full mb-4">
                        <span class="text-zinc-400 text-sm">TRENDING NOW</span>
                    </div>
                    <h2 class="text-5xl font-bold text-white">Latest Artworks</h2>
                </div>
                <a href="{{ route('categories.index') }}" class="hidden md:inline-flex items-center gap-2 px-6 py-3 bg-white text-black rounded-xl font-bold hover:bg-zinc-200 transition-all duration-200">
                    View All
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($artworks->take(8) as $index => $artwork)
                    <a href="{{ route('artworks.show', $artwork->id) }}" 
                       class="group animate-fade-up"
                       style="animation-delay: {{ $index * 0.1 }}s">
                        <div class="bg-zinc-900 rounded-2xl border border-zinc-800 overflow-hidden hover:border-zinc-700 hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                            {{-- Image --}}
                            <div class="aspect-square bg-zinc-800 overflow-hidden relative">
                                @if($artwork->image_path)
                                    <img src="/storage/{{ $artwork->image_path }}" 
                                         alt="{{ $artwork->title }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-zinc-700 to-zinc-900 flex items-center justify-center">
                                        <svg class="w-20 h-20 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                
                                {{-- Category Badge --}}
                                <div class="absolute top-3 left-3">
                                    <span class="px-3 py-1 bg-black/80 backdrop-blur-sm text-white text-xs font-semibold rounded-full border border-zinc-700">
                                        {{ $artwork->category->name }}
                                    </span>
                                </div>
                            </div>
                            
                            {{-- Info --}}
                            <div class="p-5">
                                <h3 class="text-lg font-bold text-white mb-2 truncate group-hover:text-zinc-100 transition-colors">
                                    {{ $artwork->title }}
                                </h3>
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <div class="text-sm text-zinc-500 mb-1">by {{ $artwork->user->name }}</div>
                                        <div class="text-xl font-bold text-white">Rp {{ number_format($artwork->price, 0, ',', '.') }}</div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    @auth
                                        @if(auth()->id() !== $artwork->user_id)
                                            <form method="POST" action="{{ route('cart.buy-now', $artwork) }}">
                                                @csrf
                                                <button type="submit" class="w-full px-3 py-2 bg-white text-black text-xs font-bold rounded-lg hover:bg-zinc-200 transition-colors">
                                                    Buy Now
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('cart.add', $artwork) }}">
                                                @csrf
                                                <button type="submit" class="w-full px-3 py-2 bg-zinc-800 text-white text-xs font-bold rounded-lg border border-zinc-700 hover:bg-zinc-700 transition-colors">
                                                    + Cart
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('artworks.show', $artwork->id) }}" class="col-span-2 w-full px-3 py-2 bg-zinc-800 text-white text-xs font-bold rounded-lg border border-zinc-700 hover:bg-zinc-700 transition-colors text-center">
                                                View Details
                                            </a>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="col-span-2 w-full px-3 py-2 bg-white text-black text-xs font-bold rounded-lg hover:bg-zinc-200 transition-colors text-center">
                                            Login to Buy
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-20">
                        <svg class="w-20 h-20 text-zinc-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        <h3 class="text-2xl font-bold text-white mb-2">No artworks yet</h3>
                        <p class="text-zinc-400">Be the first to upload an artwork!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="py-20 bg-black">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-up">
                <div class="inline-block px-4 py-2 bg-zinc-900 border border-zinc-800 rounded-full mb-4">
                    <span class="text-zinc-400 text-sm">WHY CHOOSE US</span>
                </div>
                <h2 class="text-5xl font-bold text-white mb-4">Effortlessly Customize</h2>
                <p class="text-zinc-400 text-lg max-w-2xl mx-auto">
                    Everything you need to find and purchase premium digital artworks
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8 hover:border-zinc-700 hover:shadow-2xl transition-all duration-300 animate-fade-up delay-100">
                    <div class="w-16 h-16 bg-zinc-800 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Quality Guaranteed</h3>
                    <p class="text-zinc-400">
                        Every artwork is carefully reviewed to ensure premium quality and authenticity before being listed.
                    </p>
                </div>

                <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8 hover:border-zinc-700 hover:shadow-2xl transition-all duration-300 animate-fade-up delay-200">
                    <div class="w-16 h-16 bg-zinc-800 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Instant Download</h3>
                    <p class="text-zinc-400">
                        Get immediate access to your purchased artworks. Download high-quality files instantly after purchase.
                    </p>
                </div>

                <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8 hover:border-zinc-700 hover:shadow-2xl transition-all duration-300 animate-fade-up delay-300">
                    <div class="w-16 h-16 bg-zinc-800 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Support Artists</h3>
                    <p class="text-zinc-400">
                        Your purchase directly supports talented artists. Fair pricing ensures creators are properly compensated.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-20 bg-gradient-to-b from-zinc-950 to-black">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-white via-zinc-100 to-zinc-200 rounded-3xl p-12 lg:p-16 text-center animate-fade-up">
                <h2 class="text-5xl lg:text-6xl font-bold text-black mb-6">
                    Ready to Get Started?
                </h2>
                <p class="text-zinc-700 text-xl mb-8 max-w-2xl mx-auto">
                    Join thousands of creators and collectors. Start exploring premium digital artworks today.
                </p>
                <div class="flex flex-wrap gap-4 justify-center">
                    @guest
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-black text-white rounded-xl font-bold hover:bg-zinc-800 transition-all duration-200 hover:scale-105 shadow-lg">
                            Create Account
                        </a>
                        <a href="{{ route('categories.index') }}" class="px-8 py-4 bg-white text-black rounded-xl font-bold border-2 border-black hover:bg-zinc-100 transition-all duration-200">
                            Browse Artworks
                        </a>
                    @else
                        <a href="{{ route('user.artworks.create') }}" class="px-8 py-4 bg-black text-white rounded-xl font-bold hover:bg-zinc-800 transition-all duration-200 hover:scale-105 shadow-lg">
                            Upload Artwork
                        </a>
                        <a href="{{ route('categories.index') }}" class="px-8 py-4 bg-white text-black rounded-xl font-bold border-2 border-black hover:bg-zinc-100 transition-all duration-200">
                            Explore More
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </section>
</div>
@endsection