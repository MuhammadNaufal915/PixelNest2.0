@extends('layouts.app')

@section('title', 'Manage Artworks - Admin')

@section('content')
<<<<<<< HEAD
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem">
        <h1>Manage Artworks</h1>
        <a href="{{ route('admin.artworks.create') }}" class="btn btn-primary">+ Create New Artwork</a>
    </div>
    <div style="margin:2rem 0;display:flex;gap:1rem">
        <a href="{{ route('admin.artworks.index') }}"
            class="btn {{ !request('status') ? 'btn-primary' : 'btn-outline' }}">All</a>
        <a href="{{ route('admin.artworks.index', ['status' => 'pending']) }}"
            class="btn {{ request('status') == 'pending' ? 'btn-primary' : 'btn-outline' }}">Pending</a>
        <a href="{{ route('admin.artworks.index', ['status' => 'approved']) }}"
            class="btn {{ request('status') == 'approved' ? 'btn-primary' : 'btn-outline' }}">Approved</a>
        <a href="{{ route('admin.artworks.index', ['status' => 'rejected']) }}"
            class="btn {{ request('status') == 'rejected' ? 'btn-primary' : 'btn-outline' }}">Rejected</a>
    </div>
    <div style="background:#fff;border-radius:1rem;padding:2rem;box-shadow:0 4px 6px rgba(0,0,0,0.1)">
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($artworks as $artwork)
                    <tr>
                        <td><img src="{{ $artwork->image_url }}"
                                style="width:80px;height:80px;object-fit:cover;border-radius:0.5rem"></td>
                        <td>{{ $artwork->title }}</td>
                        <td>{{ $artwork->user->name }}</td>
                        <td>{{ $artwork->category->name }}</td>
                        <td>Rp {{ number_format($artwork->price, 0, ',', '.') }}</td>
                        <td><span
                                class="badge badge-{{ $artwork->status === 'approved' ? 'success' : ($artwork->status === 'pending' ? 'warning' : 'danger') }}">{{ ucfirst($artwork->status) }}</span>
                        </td>
                        <td style="display:flex;gap:0.5rem">
                            <a href="{{ route('admin.artworks.show', $artwork) }}" class="btn btn-outline"
                                style="padding:0.5rem 1rem">View</a>
                            <a href="{{ route('admin.artworks.edit', $artwork) }}" class="btn btn-primary"
                                style="padding:0.5rem 1rem">Edit</a>
                            <form method="POST" action="{{ route('admin.artworks.destroy', $artwork) }}"
                                onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn"
                                    style="background:var(--danger);color:#fff;padding:0.5rem 1rem">Delete</button></form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $artworks->links() }}
    </div>
=======
<div class="min-h-screen bg-black py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                                <th class="px-6 py-4 text-left text-xs font-semibold text-zinc-400 uppercase tracking-wider">Artwork</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-zinc-400 uppercase tracking-wider">Creator</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-zinc-400 uppercase tracking-wider">Category</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-zinc-400 uppercase tracking-wider">Price</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-zinc-400 uppercase tracking-wider">Downloads</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-zinc-400 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-800">
                            @foreach($artworks as $artwork)
                                <tr class="hover:bg-zinc-800/50 transition-colors duration-200">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="w-16 h-16 bg-gradient-to-br from-zinc-700 via-zinc-800 to-black rounded-lg overflow-hidden flex-shrink-0">
                                                @if($artwork->image_path)
                                                    <img src="/storage/{{ $artwork->image_path }}" alt="{{ $artwork->title }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center">
                                                        <svg class="w-8 h-8 text-zinc-600" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="font-semibold text-white">{{ $artwork->title }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-zinc-300">{{ $artwork->user->name ?? 'Unknown' }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 bg-white/10 text-white text-xs rounded-lg border border-white/20">
                                            {{ $artwork->category->name ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-white">Rp {{ number_format($artwork->price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-zinc-300">{{ $artwork->downloads ?? 0 }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('admin.artworks.show', $artwork) }}" class="px-3 py-1.5 bg-zinc-800 text-white text-sm rounded-lg hover:bg-zinc-700 transition-all duration-200">
                                                View
                                            </a>
                                            <form method="POST" action="{{ route('admin.artworks.destroy', $artwork) }}" onsubmit="return confirm('Are you sure you want to delete this artwork?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1.5 bg-red-900/20 text-red-400 border border-red-900/50 text-sm rounded-lg hover:bg-red-900/30 hover:border-red-800 transition-all duration-200">
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
                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                    </svg>
                    <h3 class="text-2xl font-bold text-white mb-4">No artworks found</h3>
                    <p class="text-zinc-400">There are no artworks in the system yet</p>
                </div>
            </div>
        @endif
    </div>
</div>
>>>>>>> 6c9d1f181de761f38531d11c96559cf0ad585280
@endsection