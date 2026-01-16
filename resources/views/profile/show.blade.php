@extends('layouts.app')

@section('title', $user->name . ' Profile - PixelNest')

@section('content')
<div class="min-h-screen bg-black">
    {{-- Profile Header --}}
    <div class="relative h-64 bg-zinc-900 border-b border-zinc-800">
        <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-60"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-end pb-8 relative z-10">
            <div class="flex flex-col md:flex-row items-center md:items-end gap-6 text-center md:text-left">
                <div class="w-32 h-32 bg-gradient-to-br from-zinc-600 to-zinc-900 rounded-2xl flex items-center justify-center text-white text-5xl font-bold border-4 border-black shadow-2xl">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div class="mb-2">
                    <h1 class="text-4xl font-bold text-white mb-2">{{ $user->name }}</h1>
                    <div class="flex items-center gap-4 text-zinc-400 justify-center md:justify-start">
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Digital Artist
                        </span>
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Joined {{ $user->created_at->format('M Y') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Bar --}}
    <div class="bg-zinc-950 border-b border-zinc-900 sticky top-0 z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-8 py-4">
                <div class="text-center md:text-left">
                    <div class="text-white font-bold text-lg">{{ $artworks->total() }}</div>
                    <div class="text-zinc-500 text-xs uppercase tracking-wider font-semibold">Artworks</div>
                </div>
                <div class="w-px h-8 bg-zinc-800"></div>
                <div class="text-center md:text-left">
                    <div class="text-white font-bold text-lg">{{ number_format($user->artworks()->sum('downloads_count')) }}</div>
                    <div class="text-zinc-500 text-xs uppercase tracking-wider font-semibold">Total Sales</div>
                </div>
            </div>
        </div>
    </div>

    {{-- User Artworks Grid --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl font-bold text-white mb-8 flex items-center gap-3">
            Portfolio
            <span class="px-2 py-1 bg-zinc-800 rounded-md text-sm font-normal text-zinc-400">{{ $artworks->total() }}</span>
        </h2>

        @if($artworks->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($artworks as $artwork)
                    <a href="{{ route('artworks.show', $artwork) }}" class="group animate-fade-up">
                        <div class="bg-zinc-900 rounded-xl border border-zinc-800 overflow-hidden hover:border-zinc-700 hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                            <div class="aspect-square bg-zinc-800 overflow-hidden relative">
                                @if($artwork->image_path)
                                    <img src="/storage/{{ $artwork->image_path }}" 
                                         alt="{{ $artwork->title }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-zinc-700">
                                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                
                                {{-- Status Badge if pending --}}
                                @if($artwork->status === 'pending')
                                    <div class="absolute top-3 right-3 bg-yellow-500/90 backdrop-blur-sm text-black text-[10px] font-bold px-2 py-1 rounded-full uppercase tracking-wider">
                                        Pending
                                    </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="text-white font-bold truncate group-hover:text-zinc-100 mb-2">
                                    {{ $artwork->title }}
                                </h3>
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-zinc-400 font-bold">Rp {{ number_format($artwork->price, 0, ',', '.') }}</span>
                                    <div class="flex items-center gap-1 text-zinc-500 text-xs">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                                        </svg>
                                        {{ $artwork->downloads_count }}
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
                @endforeach
            </div>

            <div class="mt-12">
                {{ $artworks->links() }}
            </div>
        @else
            <div class="text-center py-24 bg-zinc-900/50 rounded-3xl border border-dashed border-zinc-800">
                <div class="w-20 h-20 bg-zinc-800 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">No artworks yet</h3>
                <p class="text-zinc-500">This artist hasn't published any artworks yet.</p>
            </div>
        @endif
    </div>
</div>
@endsection
