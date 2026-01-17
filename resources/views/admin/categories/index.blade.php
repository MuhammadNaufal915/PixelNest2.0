@extends('layouts.app')

@section('title', 'Manage Categories - Admin')

@section('content')
<div class="min-h-screen bg-black py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-10 animate-fade-in">
            <div class="flex items-center gap-4 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="p-2 bg-zinc-900 text-zinc-400 hover:text-white rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <h1 class="text-4xl font-bold text-white">Manage Categories</h1>
            </div>
            <p class="text-zinc-400 ml-14">Create and organize artwork categories for your marketplace</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            {{-- Left Column: Add New Category Form --}}
            <div class="lg:col-span-1 animate-slide-up">
                <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 sticky top-8">
                    <h2 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                        <span class="text-2xl font-light">+</span> Add New Category
                    </h2>
                    
                    <form method="POST" action="{{ route('admin.categories.store') }}">
                        @csrf
                        <div class="space-y-5">
                            <div>
                                <label for="name" class="block text-xs font-bold text-zinc-500 uppercase tracking-wider mb-2">Category Name *</label>
                                <input type="text" name="name" id="name" required placeholder="e.g. Digital Illustration"
                                    class="w-full px-4 py-3 bg-zinc-800/50 border border-zinc-700 rounded-xl text-white placeholder-zinc-600 focus:outline-none focus:ring-2 focus:ring-white/20 focus:border-zinc-600 transition-all duration-200 @error('name') border-red-500 @enderror">
                                @error('name')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="description" class="block text-xs font-bold text-zinc-500 uppercase tracking-wider mb-2">Description</label>
                                <textarea name="description" id="description" rows="4" placeholder="Brief description of this category..."
                                    class="w-full px-4 py-3 bg-zinc-800/50 border border-zinc-700 rounded-xl text-white placeholder-zinc-600 focus:outline-none focus:ring-2 focus:ring-white/20 focus:border-zinc-600 transition-all duration-200 resize-none"></textarea>
                            </div>

                            <button type="submit" class="w-full py-4 bg-white text-black rounded-xl font-bold hover:bg-zinc-200 transform hover:scale-[1.02] transition-all duration-200">
                                Create Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Right Column: Category List --}}
            <div class="lg:col-span-2 animate-slide-up" style="animation-delay: 0.1s;">
                <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">
                    {{-- List Header --}}
                    <div class="grid grid-cols-12 gap-4 px-6 py-4 border-b border-zinc-800 bg-zinc-900/50">
                        <div class="col-span-8 lg:col-span-7">
                            <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-widest">Category Detail</span>
                        </div>
                        <div class="col-span-2 lg:col-span-3 text-center">
                            <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-widest">Stats</span>
                        </div>
                        <div class="col-span-2 text-right">
                            <span class="text-[10px] font-bold text-zinc-500 uppercase tracking-widest">Actions</span>
                        </div>
                    </div>

                    {{-- List Items --}}
                    <div class="divide-y divide-zinc-800">
                        @forelse($categories as $category)
                            <div class="group transition-all duration-200 bg-zinc-900 hover:bg-zinc-800/50">
                                {{-- Main Row --}}
                                <div class="p-6 grid grid-cols-12 gap-4 items-center">
                                    {{-- Category Detail --}}
                                    <div class="col-span-8 lg:col-span-7 flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl bg-zinc-800 border border-zinc-700 flex items-center justify-center flex-shrink-0 group-hover:border-zinc-600 transition-colors">
                                            <span class="text-xl font-bold text-zinc-400 group-hover:text-white transition-colors">
                                                {{ strtoupper(substr($category->name, 0, 1)) }}
                                            </span>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-white text-lg mb-1">{{ $category->name }}</h3>
                                            <p class="text-sm text-zinc-500">{{ $category->description ?? 'No description provided' }}</p>
                                        </div>
                                    </div>

                                    {{-- Stats --}}
                                    <div class="col-span-2 lg:col-span-3 flex flex-col items-center justify-center">
                                        <span class="font-bold text-white mb-1">{{ $category->artworks_count }} Artworks</span>
                                        @if($category->artworks_count > 0)
                                            <button onclick="toggleArtworks({{ $category->id }})" class="text-[10px] font-bold text-zinc-500 uppercase tracking-wider hover:text-white transition-colors flex items-center gap-1">
                                                Click to view
                                                <svg class="w-3 h-3 transform transition-transform duration-200" id="arrow-{{ $category->id }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                                </svg>
                                            </button>
                                        @endif
                                    </div>

                                    {{-- Actions --}}
                                    <div class="col-span-2 flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        <button onclick="openEditModal({{ $category->id }}, '{{ $category->name }}', '{{ $category->description }}')"
                                            class="p-2 text-zinc-400 hover:text-white bg-zinc-800 hover:bg-zinc-700 rounded-lg transition-all" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                            </svg>
                                        </button>
                                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Delete category?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-zinc-400 hover:text-red-400 bg-zinc-800 hover:bg-red-900/20 rounded-lg transition-all" title="Delete">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                {{-- Expanded Content --}}
                                @if($category->artworks_count > 0)
                                    <div id="artworks-{{ $category->id }}" class="hidden border-t border-zinc-800 bg-black/20 p-6">
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                            @foreach($category->artworks as $artwork)
                                                <div class="group/card relative rounded-lg overflow-hidden border border-zinc-800 hover:border-zinc-600 transition-all">
                                                    <div class="aspect-square bg-zinc-800">
                                                        @if($artwork->image_path)
                                                            <img src="/storage/{{ $artwork->image_path }}" class="w-full h-full object-cover group-hover/card:scale-105 transition-transform duration-500">
                                                        @else
                                                            <div class="w-full h-full flex items-center justify-center text-zinc-600">
                                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/90 to-transparent p-3 pt-8">
                                                        <p class="text-xs font-bold text-white truncate">{{ $artwork->title }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="p-12 text-center">
                                <p class="text-zinc-500">No categories found.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="mt-6">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Edit Modal --}}
<div id="editModal" class="hidden fixed inset-0 bg-black/90 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-zinc-900 border border-zinc-800 w-full max-w-md rounded-2xl shadow-2xl p-8" onclick="event.stopPropagation()">
        <h3 class="text-2xl font-bold text-white mb-6">Edit Category</h3>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-5">
                <div>
                    <label class="block text-xs font-bold text-zinc-500 uppercase tracking-wider mb-2">Category Name</label>
                    <input type="text" name="name" id="editName" required
                        class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-white/20 focus:border-zinc-600 transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-zinc-500 uppercase tracking-wider mb-2">Description</label>
                    <input type="text" name="description" id="editDescription"
                        class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-white/20 focus:border-zinc-600 transition-all">
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" class="flex-1 py-3 bg-white text-black rounded-xl font-bold hover:bg-zinc-200 transition-all">
                        Update
                    </button>
                    <button type="button" onclick="closeEditModal()" class="flex-1 py-3 bg-zinc-800 text-white rounded-xl font-bold hover:bg-zinc-700 transition-all">
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(id, name, description) {
        const modal = document.getElementById('editModal');
        modal.classList.remove('hidden');
        document.getElementById('editForm').action = `/admin/categories/${id}`;
        document.getElementById('editName').value = name;
        document.getElementById('editDescription').value = description || '';
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    // Close modal on outside click
    document.getElementById('editModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEditModal();
        }
    });

    function toggleArtworks(categoryId) {
        const artworksRow = document.getElementById(`artworks-${categoryId}`);
        const arrow = document.getElementById(`arrow-${categoryId}`);
        
        artworksRow.classList.toggle('hidden');
        arrow.classList.toggle('rotate-180');
    }
</script>
@endsection