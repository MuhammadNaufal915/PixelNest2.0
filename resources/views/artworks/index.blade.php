@extends('layouts.app')

@section('title', 'Browse Artworks - PixelNest')

@section('content')
<div class="min-h-screen bg-black py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6 animate-fade-up">
            <div>
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 tracking-tight">Browse All Artworks</h1>
                <p class="text-zinc-400 text-lg">Discover the best digital assets from our community</p>
            </div>
            
            {{-- Filter/Sort Placeholder --}}
            <div class="flex items-center gap-4">
                <div class="px-4 py-2 bg-zinc-900 border border-zinc-800 rounded-lg text-zinc-400 text-sm cursor-default">
                    Latest First
                </div>
            </div>
        </div>

        {{-- Artworks Grid --}}
        @if(isset($artworks) && $artworks->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($artworks as $artwork)
                    <div class="group bg-zinc-900 rounded-2xl border border-zinc-800 overflow-hidden card-hover animate-fade-up" style="animation-delay: {{ $loop->index * 0.05 }}s">
                        {{-- Image Container --}}
                        <div class="relative h-64 overflow-hidden">
                            @if($artwork->image_path)
                                <img src="/storage/{{ $artwork->image_path }}" 
                                     alt="{{ $artwork->title }}" 
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            @else
                                <div class="w-full h-full bg-zinc-800 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                            
                            {{-- Category Badge --}}
                            @if($artwork->category)
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-black/60 backdrop-blur-md text-white text-[10px] uppercase tracking-widest font-bold rounded-full border border-white/10">
                                    {{ $artwork->category->name }}
                                </span>
                            </div>
                            @endif

                            {{-- Actions Overlay --}}
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-3">
                                <a href="{{ route('artworks.show', $artwork) }}" class="p-3 bg-white text-black rounded-xl hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('cart.add', $artwork) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="p-3 bg-white text-black rounded-xl hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                        {{-- Details --}}
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-white font-bold text-lg mb-1 truncate">{{ $artwork->title }}</h3>
                                    <p class="text-zinc-500 text-sm">by <span class="text-zinc-400">{{ $artwork->user->name ?? 'Unknown' }}</span></p>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between pt-4 border-t border-zinc-800">
                                <div class="text-2xl font-bold text-white">
                                    Rp {{ number_format($artwork->price, 0, ',', '.') }}
                                </div>
                                <a href="{{ route('artworks.show', $artwork) }}" class="text-sm font-bold text-zinc-400 hover:text-white transition-colors">
                                    Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if(method_exists($artworks, 'links'))
            <div class="mt-16">
                {{ $artworks->links() }}
            </div>
            @endif
        @else
            <div class="text-center py-20 bg-zinc-900/50 border border-zinc-800 rounded-3xl animate-fade-up">
                <div class="w-20 h-20 bg-zinc-800 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-white mb-2">No artworks found</h3>
                <p class="text-zinc-500">Check back later for new creative assets</p>
            </div>
        @endif
    </div>
</div>

<style>
    @keyframes fade-up {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-up {
        animation: fade-up 0.6s ease-out forwards;
    }
    .card-hover {
        transition: all 0.3s ease;
    }
    .card-hover:hover {
        transform: translateY(-8px);
        border-color: #3f3f46;
        box-shadow: 0 20px 40px rgba(0,0,0,0.4);
    }
</style>
@endsection