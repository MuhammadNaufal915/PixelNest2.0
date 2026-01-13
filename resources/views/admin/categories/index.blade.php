@extends('layouts.app')

@section('title', 'Manage Categories - Admin')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-8">Manage Categories</h1>

    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">Add New Category</h2>
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-gray-700 font-medium mb-2">Category Name *</label>
                    <input type="text" name="name" id="name" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                    <input type="text" name="description" id="description"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600">
                </div>
            </div>
            <button type="submit" class="mt-4 bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                Add Category
            </button>
        </form>
    </div>

    @if($categories->count() > 0)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Slug</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Artworks</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($categories as $category)
                        <tr>
                            <td class="px-6 py-4 font-medium">{{ $category->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $category->slug }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $category->description ?? 'N/A' }}</td>
                            <td class="px-6 py-4">
                                <span class="font-semibold">{{ $category->artworks_count }}</span>
                                @if($category->artworks_count > 0)
                                    <button onclick="toggleArtworks({{ $category->id }})" class="ml-2 text-indigo-600 hover:underline text-xs">
                                        View Artworks
                                    </button>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <button onclick="openEditModal({{ $category->id }}, '{{ $category->name }}', '{{ $category->description }}')" class="text-blue-600 hover:underline text-sm">
                                        Edit
                                    </button>
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @if($category->artworks_count > 0)
                        <tr id="artworks-{{ $category->id }}" class="hidden bg-gray-50">
                            <td colspan="5" class="px-6 py-4">
                                <div class="bg-white rounded-lg p-4 border border-gray-200">
                                    <h4 class="font-semibold text-gray-700 mb-3">Artworks in {{ $category->name }}</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                        @foreach($category->artworks as $artwork)
                                        <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                                            <div class="aspect-video bg-gray-100 overflow-hidden">
                                                @if($artwork->image_path)
                                                    <img src="/storage/{{ $artwork->image_path }}" 
                                                         alt="{{ $artwork->title }}" 
                                                         class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="p-3">
                                                <h5 class="font-medium text-sm text-gray-800 truncate mb-1">{{ $artwork->title }}</h5>
                                                <div class="flex items-center justify-between text-xs">
                                                    <span class="text-gray-600">Rp {{ number_format($artwork->price, 0, ',', '.') }}</span>
                                                    <span class="px-2 py-1 rounded-full text-xs font-medium
                                                        @if($artwork->status === 'approved') bg-green-100 text-green-800
                                                        @elseif($artwork->status === 'pending') bg-yellow-100 text-yellow-800
                                                        @else bg-red-100 text-red-800
                                                        @endif">
                                                        {{ ucfirst($artwork->status) }}
                                                    </span>
                                                </div>
                                                <p class="text-xs text-gray-500 mt-1">By {{ $artwork->user->name }}</p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $categories->links() }}
        </div>
    @endif
</div>

<!-- Edit Modal -->
<div id="editModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-8 border w-96 shadow-lg rounded-md bg-white">
        <h3 class="text-lg font-semibold mb-4">Edit Category</h3>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Category Name</label>
                <input type="text" name="name" id="editName" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Description</label>
                <input type="text" name="description" id="editDescription" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600">
            </div>
            <div class="flex space-x-2">
                <button type="submit" class="flex-1 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Update</button>
                <button type="button" onclick="closeEditModal()" class="flex-1 bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditModal(id, name, description) {
    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('editForm').action = `/admin/categories/${id}`;
    document.getElementById('editName').value = name;
    document.getElementById('editDescription').value = description || '';
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}

function toggleArtworks(categoryId) {
    const artworksRow = document.getElementById(`artworks-${categoryId}`);
    artworksRow.classList.toggle('hidden');
}
</script>
@endsection