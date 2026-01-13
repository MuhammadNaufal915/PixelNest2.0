@extends('layouts.app')

@section('title', 'Search Results - PixelNest')

@section('content')
<div class="min-h-screen bg-black py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-white mb-2">Search Results</h1>
            <p class="text-zinc-400">
                @if($query)
                    Showing results for "<span class="text-white font-semibold">{{ $query }}</span>"
                @else
                    Please enter a search term
                @endif
            </p>
        </div>

        {{-- Results --}}
        @if($artworks->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($artworks as $artwork)
                    <a href="{{ route('artworks.show', $artwork->id) }}" class="group">
                        <div class="bg-zinc-900 rounded-xl border border-zinc-800 overflow-hidden hover:border-zinc-700 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                            {{-- Image --}}
                            <div class="aspect-square bg-zinc-800 overflow-hidden">
                                <img src="{{ asset('storage/' . $artwork->image_path) }}" 
                                     alt="{{ $artwork->title }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            </div>
                            
                            {{-- Info --}}
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-white mb-1 truncate group-hover:text-zinc-100">
                                    {{ $artwork->title }}
                                </h3>
                                <p class="text-zinc-500 text-sm mb-2">{{ $artwork->category->name }}</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-white font-bold">Rp {{ number_format($artwork->price, 0, ',', '.') }}</span>
                                    <span class="text-zinc-500 text-sm">by {{ $artwork->user->name }}</span>
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <h3 class="text-2xl font-bold text-white mb-2">No results found</h3>
                <p class="text-zinc-400 mb-6">Try searching with different keywords</p>
                <a href="{{ route('home') }}" class="inline-block px-6 py-3 bg-white text-black rounded-xl font-bold hover:bg-zinc-200 transition-colors duration-200">
                    Browse All Artworks
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
