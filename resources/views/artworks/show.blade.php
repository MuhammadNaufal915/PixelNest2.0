@extends('layouts.app')

@section('title', $artwork->title . ' - PixelNest')

@section('content')
<div class="min-h-screen bg-black">
    {{-- Breadcrumb --}}
    <div class="bg-zinc-950 border-b border-zinc-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center gap-2 text-sm">
                <a href="{{ route('home') }}" class="text-zinc-500 hover:text-white transition-colors">Home</a>
                <svg class="w-4 h-4 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('categories.show', $artwork->category->id) }}" class="text-zinc-500 hover:text-white transition-colors">{{ $artwork->category->name }}</a>
                <svg class="w-4 h-4 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-white font-medium truncate">{{ $artwork->title }}</span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Main Content --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-20">
            {{-- Left: Image Preview (2 columns) --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Main Image --}}
                <div class="relative group animate-fade-up">
                    <div class="aspect-video bg-zinc-900 rounded-2xl border border-zinc-800 overflow-hidden">
                        @if($artwork->image_path)
                            <img src="/storage/{{ $artwork->image_path }}" 
                                 alt="{{ $artwork->title }}" 
                                 class="w-full h-full object-contain">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-32 h-32 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    
                    {{-- Zoom Button --}}
                    <button class="absolute top-4 right-4 p-3 bg-black/80 backdrop-blur-sm text-white rounded-xl border border-zinc-700 hover:bg-black transition-all duration-200 opacity-0 group-hover:opacity-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                        </svg>
                    </button>
                </div>

                {{-- Details Tabs --}}
                <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8 animate-fade-up delay-100">
                    <div class="border-b border-zinc-800 mb-6">
                        <div class="flex gap-6">
                            <button class="pb-4 border-b-2 border-white text-white font-semibold">Description</button>
                            <button class="pb-4 border-b-2 border-transparent text-zinc-500 font-semibold hover:text-white transition-colors">Details</button>
                            <button class="pb-4 border-b-2 border-transparent text-zinc-500 font-semibold hover:text-white transition-colors">License</button>
                        </div>
                    </div>

                    {{-- Description Content --}}
                    <div>
                        <h3 class="text-xl font-bold text-white mb-4">About this artwork</h3>
                        <p class="text-zinc-400 leading-relaxed mb-6">
                            {{ $artwork->description ?? 'No description available for this artwork.' }}
                        </p>

                        {{-- Specifications --}}
                        <div class="grid grid-cols-2 gap-4 pt-6 border-t border-zinc-800">
                            <div>
                                <div class="text-sm text-zinc-500 mb-1">Category</div>
                                <div class="text-white font-semibold">{{ $artwork->category->name }}</div>
                            </div>
                            <div>
                                <div class="text-sm text-zinc-500 mb-1">File Format</div>
                                <div class="text-white font-semibold">{{ strtoupper(pathinfo($artwork->file_path ?? '', PATHINFO_EXTENSION)) ?: 'N/A' }}</div>
                            </div>
                            <div>
                                <div class="text-sm text-zinc-500 mb-1">Downloads</div>
                                <div class="text-white font-semibold">{{ $artwork->downloads ?? 0 }} times</div>
                            </div>
                            <div>
                                <div class="text-sm text-zinc-500 mb-1">Published</div>
                                <div class="text-white font-semibold">{{ $artwork->created_at->format('M d, Y') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right: Purchase Card (1 column) --}}
            <div class="lg:col-span-1">
                <div class="sticky top-24 space-y-6">
                    {{-- Price Card --}}
                    <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 animate-fade-up delay-200">
                        {{-- Price --}}
                        <div class="mb-6">
                            <div class="text-sm text-zinc-500 mb-2">Price</div>
                            <div class="text-4xl font-bold text-white mb-1">
                                Rp {{ number_format($artwork->price, 0, ',', '.') }}
                            </div>
                            <div class="text-sm text-zinc-500">One-time payment</div>
                        </div>

                        {{-- Action Button --}}
                        @auth
                            @if(auth()->id() !== $artwork->user_id)
                                @if(!auth()->user()->isBanned())
                                    <form method="POST" action="{{ route('cart.buy-now', $artwork) }}" class="mb-4">
                                        @csrf
                                        <button type="submit" class="w-full px-6 py-4 bg-white text-black rounded-xl font-bold hover:bg-zinc-200 transition-all duration-200 flex items-center justify-center gap-2 group">
                                            Buy Now
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('cart.add', $artwork) }}">
                                        @csrf
                                        <button type="submit" class="w-full px-6 py-3 bg-zinc-800 text-white rounded-xl font-semibold hover:bg-zinc-700 transition-all duration-200 border border-zinc-700">
                                            Add to Cart
                                        </button>
                                    </form>
                                @else
                                    <div class="bg-red-900/20 border border-red-500/50 text-red-300 px-4 py-3 rounded-xl text-sm">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            <span>Account banned</span>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="bg-zinc-800 border border-zinc-700 text-zinc-300 px-4 py-3 rounded-xl text-center text-sm">
                                    <svg class="w-6 h-6 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                    This is your artwork
                                </div>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="block w-full px-6 py-4 bg-white text-black rounded-xl font-bold hover:bg-zinc-200 transition-all duration-200 text-center">
                                Login to Purchase
                            </a>
                        @endauth

                        {{-- Features --}}
                        <div class="mt-6 pt-6 border-t border-zinc-800 space-y-3">
                            <div class="flex items-center gap-3 text-sm text-zinc-400">
                                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Instant download</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-zinc-400">
                                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Commercial license</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-zinc-400">
                                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Lifetime access</span>
                            </div>
                        </div>
                    </div>

                    {{-- Artist Card --}}
                    <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 animate-fade-up delay-300">
                        <div class="text-sm text-zinc-500 mb-4">Created by</div>
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-zinc-600 to-zinc-800 rounded-full flex items-center justify-center text-white text-xl font-bold ring-2 ring-zinc-700">
                                {{ strtoupper(substr($artwork->user->name, 0, 1)) }}
                            </div>
                            <div class="flex-1">
                                <div class="font-bold text-white text-lg">{{ $artwork->user->name }}</div>
                                <div class="text-sm text-zinc-500">Digital Artist</div>
                            </div>
                        </div>
                        <a href="{{ route('profile.show', $artwork->user->id) }}" class="block w-full px-4 py-2 bg-zinc-800 text-white rounded-lg font-semibold hover:bg-zinc-700 transition-all duration-200 border border-zinc-700 text-center">
                            View Profile
                        </a>
                    </div>

                    {{-- Share Card --}}
                    <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 animate-fade-up delay-400">
                        <div class="text-sm text-zinc-500 mb-4">Share this artwork</div>
                        <div class="flex gap-2">
                            <button class="flex-1 p-3 bg-zinc-800 rounded-lg hover:bg-zinc-700 transition-colors border border-zinc-700">
                                <svg class="w-5 h-5 text-white mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </button>
                            <button class="flex-1 p-3 bg-zinc-800 rounded-lg hover:bg-zinc-700 transition-colors border border-zinc-700">
                                <svg class="w-5 h-5 text-white mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </button>
                            <button class="flex-1 p-3 bg-zinc-800 rounded-lg hover:bg-zinc-700 transition-colors border border-zinc-700">
                                <svg class="w-5 h-5 text-white mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Related Artworks --}}
        @if(isset($relatedArtworks) && $relatedArtworks->count() > 0)
            <div class="animate-fade-up">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-3xl font-bold text-white">More from this category</h2>
                    <a href="{{ route('categories.show', $artwork->category->id) }}" class="text-zinc-400 hover:text-white transition-colors flex items-center gap-2">
                        View all
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedArtworks as $index => $related)
                        <a href="{{ route('artworks.show', $related) }}" 
                           class="group animate-fade-up"
                           style="animation-delay: {{ $index * 0.1 }}s">
                            <div class="bg-zinc-900 rounded-2xl border border-zinc-800 overflow-hidden hover:border-zinc-700 hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                                <div class="aspect-square bg-zinc-800 overflow-hidden">
                                    @if($related->image_path)
                                        <img src="/storage/{{ $related->image_path }}" 
                                             alt="{{ $related->title }}"
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-zinc-700 to-zinc-900 flex items-center justify-center">
                                            <svg class="w-20 h-20 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-5">
                                    <h3 class="text-lg font-bold text-white mb-2 truncate group-hover:text-zinc-100">
                                        {{ $related->title }}
                                    </h3>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xl font-bold text-white">Rp {{ number_format($related->price, 0, ',', '.') }}</span>
                                        <div class="w-8 h-8 bg-zinc-800 rounded-full flex items-center justify-center group-hover:bg-white transition-colors duration-300">
                                            <svg class="w-4 h-4 text-zinc-400 group-hover:text-black transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection