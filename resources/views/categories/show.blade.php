@extends('layouts.app')

@section('title', $category->name . ' - PixelNest')

@section('content')
<div class="min-h-screen bg-black py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-12 text-center animate-fade-up">
            <h1 class="text-5xl font-bold text-white mb-4">{{ $category->name }}</h1>
            <p class="text-zinc-400 text-lg">{{ $artworks->total() }} artworks available</p>
        </div>

        {{-- Artworks Grid --}}
        @if($artworks->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($artworks as $artwork)
                    <a href="{{ route('artworks.show', $artwork->id) }}" class="group animate-fade-up">
                        <div class="bg-zinc-900 rounded-xl border border-zinc-800 overflow-hidden hover:border-zinc-700 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                            {{-- Image --}}
                            <div class="aspect-square bg-zinc-800 overflow-hidden">
                                <img src="/storage/{{ $artwork->image_path }}" 
                                     alt="{{ $artwork->title }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            </div>
                            
                            {{-- Info --}}
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-white mb-2 truncate group-hover:text-zinc-100">
                                    {{ $artwork->title }}
                                </h3>
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-white font-bold">Rp {{ number_format($artwork->price, 0, ',', '.') }}</span>
                                    <span class="text-zinc-500 text-sm">by {{ $artwork->user->name }}</span>
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
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $artworks->links() }}
            </div>
        @else
            <div class="text-center py-20">
                <svg class="w-20 h-20 text-zinc-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
                <h3 class="text-2xl font-bold text-white mb-2">No artworks yet</h3>
                <p class="text-zinc-400 mb-6">Be the first to upload an artwork in this category!</p>
                <a href="{{ route('home') }}" class="inline-block px-6 py-3 bg-white text-black rounded-xl font-bold hover:bg-zinc-200 transition-colors duration-200">
                    Browse Other Categories
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
