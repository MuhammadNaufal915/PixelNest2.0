@extends('layouts.app')

@section('title', 'My Artworks - PixelNest')

@section('content')
<div class="min-h-screen bg-black py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
            <div>
                <h1 class="text-4xl font-bold text-white mb-2">My Artworks</h1>
                <p class="text-zinc-400">Manage and showcase your creative works</p>
            </div>
            <a href="{{ route('user.artworks.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-black rounded-xl font-bold hover:bg-zinc-200 transition-all duration-200 shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Upload New Artwork
            </a>
        </div>

        @if(isset($artworks) && $artworks->count() > 0)
            <!-- Artworks Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($artworks as $artwork)
                    <div class="group bg-gradient-to-br from-zinc-900 via-zinc-800 to-zinc-900 rounded-2xl border border-zinc-800 hover:border-zinc-700 overflow-hidden transition-all duration-300 shadow-xl">
                        {{-- Image --}}
                        <div class="relative h-64 bg-gradient-to-br from-zinc-700 via-zinc-800 to-black overflow-hidden">
                            @if($artwork->image_path)
                                <img src="{{ asset('storage/' . $artwork->image_path) }}" 
                                     alt="{{ $artwork->title }}" 
                                     class="w-full h-full object-cover transition-transform duration-300"
                                     onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22300%22%3E%3Crect fill=%22%2327272a%22 width=%22400%22 height=%22300%22/%3E%3Ctext fill=%22%2371717a%22 font-family=%22sans-serif%22 font-size=%2224%22 dy=%2210.5%22 font-weight=%22bold%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22%3ENo Image%3C/text%3E%3C/svg%3E';">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-20 h-20 text-zinc-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
                                    </svg>
                                </div>
                            @endif
                            
                            {{-- Status Badge --}}
                            <div class="absolute top-4 left-4">
                                @if($artwork->status === 'approved')
                                    <span class="px-3 py-1.5 bg-green-500/20 backdrop-blur-sm text-green-400 text-xs font-bold rounded-lg border border-green-500/30">
                                        Approved
                                    </span>
                                @elseif($artwork->status === 'pending')
                                    <span class="px-3 py-1.5 bg-yellow-500/20 backdrop-blur-sm text-yellow-400 text-xs font-bold rounded-lg border border-yellow-500/30">
                                        Pending
                                    </span>
                                @else
                                    <span class="px-3 py-1.5 bg-red-500/20 backdrop-blur-sm text-red-400 text-xs font-bold rounded-lg border border-red-500/30">
                                        Rejected
                                    </span>
                                @endif
                            </div>

                            {{-- Stats Overlay --}}
                            <div class="absolute top-4 right-4">
                                <div class="px-3 py-1.5 bg-black/70 backdrop-blur-sm text-white text-xs rounded-lg border border-white/20 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $artwork->downloads ?? 0 }}
                                </div>
                            </div>
                        </div>

                        {{-- Info --}}
                        <div class="p-6">
                            <!-- Title -->
                            <h3 class="font-bold text-xl mb-2 text-white truncate">
                                {{ $artwork->title }}
                            </h3>
                            
                            <!-- Category -->
                            <span class="inline-block px-3 py-1 bg-white/10 text-white text-xs font-bold rounded-lg mb-3">
                                {{ $artwork->category->name ?? 'Uncategorized' }}
                            </span>
                            
                            <!-- Price -->
                            <p class="text-2xl font-bold text-white mb-4">
                                Rp {{ number_format($artwork->price, 0, ',', '.') }}
                            </p>
                            
                            <!-- Actions -->
                            <div class="flex gap-3 pt-4 border-t border-zinc-700">
                                <a href="{{ route('user.artworks.edit', $artwork) }}" 
                                   class="flex-1 text-center px-4 py-2.5 bg-zinc-800 text-white rounded-xl text-sm font-bold hover:bg-zinc-700 transition-all duration-200 border border-zinc-700">
                                    Edit
                                </a>
                                <form method="POST" 
                                      action="{{ route('user.artworks.destroy', $artwork) }}" 
                                      class="flex-1" 
                                      onsubmit="return confirm('Are you sure you want to delete this artwork?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-full px-4 py-2.5 bg-red-900/20 text-red-400 border border-red-900/50 rounded-xl text-sm font-bold hover:bg-red-900/30 hover:border-red-800 transition-all duration-200">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-10">
                {{ $artworks->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <div class="inline-block p-12 bg-gradient-to-br from-zinc-900 via-zinc-800 to-zinc-900 rounded-3xl border border-zinc-800 shadow-2xl">
                    <div class="w-24 h-24 bg-white/5 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-zinc-600" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-3">No Artworks Yet</h3>
                    <p class="text-zinc-400 mb-8 max-w-md mx-auto">You haven't uploaded any artworks yet. Start sharing your creative work with the community!</p>
                    <a href="{{ route('user.artworks.create') }}" 
                       class="inline-flex items-center gap-2 px-8 py-3 bg-white text-black rounded-xl font-bold hover:bg-zinc-200 transition-all duration-200 shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Upload Your First Artwork
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection