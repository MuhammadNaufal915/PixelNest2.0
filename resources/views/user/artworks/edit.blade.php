@extends('layouts.app')

@section('title', 'Edit Artwork - PixelNest')

@section('content')
<div class="min-h-screen bg-black py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-white mb-2">Edit Artwork</h1>
            <p class="text-zinc-400">Update your creative work details</p>
        </div>

        <!-- Form Card -->
        <div class="bg-gradient-to-br from-zinc-900 via-zinc-800 to-zinc-900 rounded-2xl border border-zinc-800 p-8 shadow-2xl">
            <form method="POST" action="{{ route('user.artworks.update', $artwork) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div>
                    <label for="title" class="block text-white font-semibold mb-2">
                        Title <span class="text-red-400">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title', $artwork->title) }}" 
                           required
                           placeholder="Enter artwork title"
                           class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-xl text-white placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-white/20 focus:border-zinc-600 transition-all duration-200 @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="text-red-400 text-sm mt-2 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-white font-semibold mb-2">
                        Description <span class="text-red-400">*</span>
                    </label>
                    <textarea name="description" 
                              id="description" 
                              rows="4" 
                              required
                              placeholder="Describe your artwork..."
                              class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-xl text-white placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-white/20 focus:border-zinc-600 transition-all duration-200 resize-none @error('description') border-red-500 @enderror">{{ old('description', $artwork->description) }}</textarea>
                    @error('description')
                        <p class="text-red-400 text-sm mt-2 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Category & Price Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Category -->
                    <div>
                        <label for="category_id" class="block text-white font-semibold mb-2">
                            Category <span class="text-red-400">*</span>
                        </label>
                        <select name="category_id" 
                                id="category_id" 
                                required
                                class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-white/20 focus:border-zinc-600 transition-all duration-200 @error('category_id') border-red-500 @enderror">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" class="bg-zinc-800" {{ old('category_id', $artwork->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-400 text-sm mt-2 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-white font-semibold mb-2">
                            Price (Rp) <span class="text-red-400">*</span>
                        </label>
                        <input type="number" 
                               name="price" 
                               id="price" 
                               value="{{ old('price', $artwork->price) }}" 
                               step="1000" 
                               min="0" 
                               required
                               placeholder="50000"
                               class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700 rounded-xl text-white placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-white/20 focus:border-zinc-600 transition-all duration-200 @error('price') border-red-500 @enderror">
                        @error('price')
                            <p class="text-red-400 text-sm mt-2 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Current Preview Image -->
                <div>
                    <label class="block text-white font-semibold mb-3">Current Preview Image</label>
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $artwork->image_path) }}" 
                             alt="{{ $artwork->title }}" 
                             class="w-full max-w-md h-64 object-cover rounded-xl border border-zinc-700"
                             onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22300%22%3E%3Crect fill=%22%2327272a%22 width=%22400%22 height=%22300%22/%3E%3Ctext fill=%22%2371717a%22 font-family=%22sans-serif%22 font-size=%2224%22 dy=%2210.5%22 font-weight=%22bold%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22%3ENo Image%3C/text%3E%3C/svg%3E';">
                    </div>
                </div>

                <!-- Change Preview Image -->
                <div>
                    <label for="image" class="block text-white font-semibold mb-2">
                        Change Preview Image <span class="text-zinc-500">(Optional)</span>
                    </label>
                    <div class="relative">
                        <input type="file" 
                               name="image" 
                               id="image" 
                               accept="image/*"
                               class="hidden"
                               onchange="previewImage(event)">
                        <label for="image" class="flex items-center justify-center w-full px-4 py-8 bg-zinc-800 border-2 border-dashed border-zinc-700 rounded-xl cursor-pointer hover:border-zinc-600 hover:bg-zinc-800/50 transition-all duration-200 @error('image') border-red-500 @enderror">
                            <div class="text-center">
                                <svg class="w-12 h-12 text-zinc-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-white font-medium mb-1">Click to upload new preview image</p>
                                <p class="text-zinc-500 text-sm">JPG, PNG, GIF - Max 2MB</p>
                            </div>
                        </label>
                    </div>
                    <div id="imagePreview" class="mt-4 hidden">
                        <img src="" alt="Preview" class="w-full h-64 object-cover rounded-xl border border-zinc-700">
                    </div>
                    @error('image')
                        <p class="text-red-400 text-sm mt-2 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Change Artwork File -->
                <div>
                    <label for="file" class="block text-white font-semibold mb-2">
                        Change Artwork File <span class="text-zinc-500">(Optional)</span>
                    </label>
                    <div class="relative">
                        <input type="file" 
                               name="file" 
                               id="file"
                               class="hidden"
                               onchange="showFileName(event)">
                        <label for="file" class="flex items-center justify-center w-full px-4 py-8 bg-zinc-800 border-2 border-dashed border-zinc-700 rounded-xl cursor-pointer hover:border-zinc-600 hover:bg-zinc-800/50 transition-all duration-200 @error('file') border-red-500 @enderror">
                            <div class="text-center">
                                <svg class="w-12 h-12 text-zinc-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                <p class="text-white font-medium mb-1">Click to upload new artwork file</p>
                                <p class="text-zinc-500 text-sm">ZIP, PDF, AI, PSD, SKETCH, FIG - Max 10MB</p>
                            </div>
                        </label>
                    </div>
                    <div id="fileName" class="mt-3 hidden">
                        <div class="flex items-center gap-2 px-4 py-2 bg-zinc-800 rounded-lg border border-zinc-700">
                            <svg class="w-5 h-5 text-zinc-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-white text-sm" id="fileNameText"></span>
                        </div>
                    </div>
                    @error('file')
                        <p class="text-red-400 text-sm mt-2 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-zinc-700">
                    <button type="submit" class="flex-1 px-6 py-3 bg-white text-black rounded-xl font-bold hover:bg-zinc-200 transition-all duration-200 shadow-lg">
                        Update Artwork
                    </button>
                    <a href="{{ route('user.artworks.index') }}" class="flex-1 px-6 py-3 bg-zinc-800 text-white rounded-xl font-bold hover:bg-zinc-700 transition-all duration-200 text-center border border-zinc-700">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('imagePreview');
    const img = preview.querySelector('img');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}

function showFileName(event) {
    const fileNameDiv = document.getElementById('fileName');
    const fileNameText = document.getElementById('fileNameText');
    const file = event.target.files[0];
    
    if (file) {
        fileNameText.textContent = file.name;
        fileNameDiv.classList.remove('hidden');
    }
}
</script>
@endsection