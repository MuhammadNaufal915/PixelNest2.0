@extends('layouts.app')

@section('title', 'All Artworks - PixelNest')

@section('content')
<div class="min-h-screen bg-black py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4 animate-fade-in">
            <div>
                <h1 class="text-4xl font-bold text-white mb-2">All Artworks</h1>
                <p class="text-zinc-400">Discover amazing digital creations</p>
            </div>
            
            {{-- Filter/Sort (if needed) --}}
            <div class="flex gap-3">
                <select class="px-4 py-2 bg-zinc-900 border border-zinc-800 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent">
                    <option>All Categories</option>
                    <option>Design</option>
                    <option>Illustration</option>
                    <option>Photography</option>
                </select>
                <select class="px-4 py-2 bg-zinc-900 border border-zinc-800 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent">
                    <option>Sort by: Latest</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                    <option>Most Popular</option>
                </select>
            </div>
        </div>

        @if(isset($artworks) && $artworks->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 animate-slide-up">
                @foreach($artworks as $artwork)
                    <div class="group bg-zinc-900 rounded-xl border border-zinc-800 overflow-hidden card-hover">
                        {{-- Image --}}
                        <div class="relative h-56 bg-gradient-to-br from-zinc-700 via-zinc-800 to-black overflow-hidden">
                            @if($artwork->image_path)
                                <img src="{{ asset('storage/' . $artwork->image_path) }}" 
                                     alt="{{ $artwork->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-20 h-20 text-zinc-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
                                    </svg>
                                </div>
                            @endif
                            
                            {{-- Quick View Overlay --}}
                            <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <a href="{{ route('artworks.show', $artwork) }}" class="px-6 py-2.5 bg-white text-black rounded-lg font-semibold hover:bg-gray-100 transition-all duration-200">
                                    Quick View
                                </a>
                            </div>

                            {{-- Category Badge --}}
                            @if(isset($artwork->category))
                                <div class="absolute top-3 left-3 px-3 py-1 bg-black/70 backdrop-blur-sm text-white text-xs rounded-lg border border-white/20">
                                    {{ $artwork->category->name }}
                                </div>
                            @endif
                        </div>

                        {{-- Info --}}
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

            {{-- Pagination --}}
            @if(method_exists($artworks, 'links'))
                <div class="mt-12">
                    {{ $artworks->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-16 animate-scale-in">
                <div class="inline-block p-12 bg-zinc-900 rounded-2xl border border-zinc-800">
                    <svg class="w-24 h-24 text-zinc-600 mx-auto mb-6" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                    </svg>
                    <h3 class="text-2xl font-bold text-white mb-4">No artworks found</h3>
                    <p class="text-zinc-400">Check back later for new artworks</p>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection