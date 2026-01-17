@extends('layouts.app')

@section('title', 'Manage Artworks - Admin')

@section('content')
    <div class="min-h-screen bg-black py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Back Button --}}
            <div class="mb-6 animate-fade-in">
                <a href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-zinc-900 text-white rounded-lg border border-zinc-800 hover:bg-zinc-800 hover:border-zinc-700 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span class="font-medium">Back to Dashboard</span>
                </a>
            </div>

            <div class="flex justify-between items-center mb-8 animate-fade-in">
                <div>
                    <h1 class="text-4xl font-bold text-white mb-2">Manage Artworks</h1>
                    <p class="text-zinc-400">View and manage all artworks in the system</p>
                </div>
            </div>

            @if(isset($artworks) && $artworks->count() > 0)
                {{-- Table Container --}}
                <div class="bg-zinc-900 border border-zinc-800 rounded-xl overflow-hidden animate-slide-up">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-zinc-800/50 border-b border-zinc-800">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-zinc-400 uppercase tracking-wider">
                                        Artwork</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-zinc-400 uppercase tracking-wider">
                                        Creator</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-zinc-400 uppercase tracking-wider">
                                        Category</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-zinc-400 uppercase tracking-wider">
                                        Price</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-zinc-400 uppercase tracking-wider">
                                        Downloads</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-zinc-400 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-800">
                                @foreach($artworks as $artwork)
                                    <tr class="hover:bg-zinc-800/50 transition-colors duration-200">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                <div
                                                    class="w-16 h-16 bg-gradient-to-br from-zinc-700 via-zinc-800 to-black rounded-lg overflow-hidden flex-shrink-0">
                                                    @if($artwork->image_path)
                                                        <img src="/storage/{{ $artwork->image_path }}" alt="{{ $artwork->title }}"
                                                            class="w-full h-full object-cover">
                                                    @else
                                                        <div class="w-full h-full flex items-center justify-center">
                                                            <svg class="w-8 h-8 text-zinc-600" fill="currentColor" viewBox="0 0 24 24">
                                                                <path
                                                                    d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" />
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="font-semibold text-white">{{ $artwork->title }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-zinc-300">{{ $artwork->user->name ?? 'Unknown' }}</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-3 py-1 bg-white/10 text-white text-xs rounded-lg border border-white/20">
                                                {{ $artwork->category->name ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 font-bold text-white">Rp
                                            {{ number_format($artwork->price, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-zinc-300">{{ $artwork->downloads ?? 0 }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <a href="{{ route('admin.artworks.show', $artwork) }}"
                                                    class="px-3 py-1.5 bg-zinc-800 text-white text-sm rounded-lg hover:bg-zinc-700 transition-all duration-200">
                                                    View
                                                </a>
                                                <form method="POST" action="{{ route('admin.artworks.destroy', $artwork) }}"
                                                    onsubmit="return confirm('Are you sure you want to delete this artwork?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-3 py-1.5 bg-red-900/20 text-red-400 border border-red-900/50 text-sm rounded-lg hover:bg-red-900/30 hover:border-red-800 transition-all duration-200">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Pagination --}}
                <div class="mt-8">
                    {{ $artworks->links() }}
                </div>
            @else
                <div class="text-center py-16 animate-scale-in">
                    <div class="inline-block p-12 bg-zinc-900 rounded-2xl border border-zinc-800">
                        <svg class="w-24 h-24 text-zinc-600 mx-auto mb-6" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                clip-rule="evenodd" />
                        </svg>
                        <h3 class="text-2xl font-bold text-white mb-4">No artworks found</h3>
                        <p class="text-zinc-400">There are no artworks in the system yet</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection