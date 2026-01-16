@extends('layouts.app')

@section('title', 'Welcome - PixelNest')

@section('content')
<div class="min-h-screen bg-black">
    {{-- Hero Section --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 animate-fade-in">
        <div class="text-center mb-16">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold tracking-tight mb-6 leading-tight">
                Discover Amazing
                <span class="block text-gradient">Digital Artworks</span>
            </h1>
            <p class="text-xl text-zinc-400 max-w-2xl mx-auto leading-relaxed">
                Buy and sell digital designs, illustrations, and creative assets
            </p>
        </div>

        {{-- Categories Section --}}
        @if(isset($categories) && $categories->count() > 0)
            <div class="mb-16 animate-slide-up">
                <h2 class="text-3xl font-bold mb-8 text-white">Categories</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($categories as $category)
                        <div class="group bg-zinc-900 border border-zinc-800 rounded-xl p-6 hover:border-zinc-700 card-hover cursor-pointer">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-semibold text-white">{{ $category->name }}</span>
                                <svg class="w-5 h-5 text-zinc-600 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                            <span class="text-sm text-zinc-500">({{ $category->artworks_count ?? 0 }} artworks)</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Latest Artworks --}}
        @if(isset($artworks) && $artworks->count() > 0)
            <div class="animate-slide-up">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-3xl font-bold text-white">Latest Artworks</h2>
                    <a href="{{ route('artworks.index') }}" class="text-sm text-zinc-400 hover:text-white transition-colors duration-200 flex items-center gap-2">
                        View All
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($artworks as $artwork)
                        <div class="group bg-zinc-900 rounded-xl border border-zinc-800 overflow-hidden card-hover">
                            {{-- Artwork Image --}}
                            <div class="relative h-56 bg-gradient-to-br from-zinc-700 via-zinc-800 to-black overflow-hidden">
                                @if($artwork->image_path)
                                    <img src="/storage/{{ $artwork->image_path }}" 
                                         alt="{{ $artwork->title }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-20 h-20 text-zinc-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
                                        </svg>
                                    </div>
                                @endif
                                {{-- Overlay on hover --}}
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <a href="{{ route('artworks.show', $artwork) }}" class="px-6 py-2.5 bg-white text-black rounded-lg font-semibold hover:bg-gray-100 transition-all duration-200">
                                        View Details
                                    </a>
                                </div>
                            </div>

                            {{-- Artwork Info --}}
                            <div class="p-5">
                                <h3 class="font-bold text-lg mb-2 text-white truncate">{{ $artwork->title }}</h3>
                                <p class="text-zinc-400 text-sm mb-4">by {{ $artwork->user->name ?? 'Unknown' }}</p>
                                
                                <div class="flex justify-between items-center pt-4 border-t border-zinc-800">
                                    <span class="text-xl font-bold text-white">Rp {{ number_format($artwork->price, 0, ',', '.') }}</span>
                                    <a href="{{ route('artworks.show', $artwork) }}" class="px-4 py-2 bg-zinc-800 text-white rounded-lg text-sm font-semibold hover:bg-zinc-700 transition-all duration-200">
                                        View
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="text-center py-16">
                <div class="inline-block p-8 bg-zinc-900 rounded-2xl border border-zinc-800">
                    <svg class="w-16 h-16 text-zinc-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <p class="text-zinc-400 text-lg">No artworks available yet</p>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection