@extends('layouts.app')

@section('title', 'Categories - PixelNest')

@section('content')
<div class="min-h-screen bg-black py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-12 animate-fade-up">
            <h1 class="text-5xl font-bold text-white mb-4">Browse Categories</h1>
            <p class="text-zinc-400 text-lg">Explore digital artworks by category</p>
        </div>

        {{-- Categories Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($categories as $category)
                <a href="{{ route('categories.show', $category->id) }}" class="group">
                    <div class="bg-gradient-to-br from-zinc-900 via-zinc-800 to-zinc-900 rounded-2xl border border-zinc-800 p-6 hover:border-zinc-700 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                        {{-- Icon --}}
                        <div class="w-16 h-16 bg-zinc-800 rounded-xl flex items-center justify-center mb-4 group-hover:bg-zinc-700 transition-colors duration-300">
                            <svg class="w-8 h-8 text-zinc-400 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        
                        {{-- Category Name --}}
                        <h3 class="text-xl font-bold text-white mb-2 group-hover:text-zinc-100 transition-colors duration-300">
                            {{ $category->name }}
                        </h3>
                        
                        {{-- Artwork Count --}}
                        <p class="text-zinc-500 text-sm">
                            {{ $category->artworks_count ?? 0 }} artworks
                        </p>
                        
                        {{-- Arrow --}}
                        <div class="mt-4 flex items-center text-zinc-500 group-hover:text-white transition-colors duration-300">
                            <span class="text-sm font-medium">Explore</span>
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-12">
                    <svg class="w-16 h-16 text-zinc-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <p class="text-zinc-500 text-lg">No categories available yet</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
