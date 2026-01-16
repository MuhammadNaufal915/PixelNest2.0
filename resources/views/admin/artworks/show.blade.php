@extends('layouts.app')

@section('title', 'Artwork Details - Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">Artwork Details</h1>
        <a href="{{ route('admin.artworks.index') }}" class="text-indigo-600 hover:underline">← Back to Artworks</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div>
            <img src="{{ asset('storage/' . $artwork->image_path) }}" alt="{{ $artwork->title }}" class="w-full rounded-lg shadow-lg">
        </div>

        <div class="bg-white rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-bold mb-4">{{ $artwork->title }}</h2>
            
            <div class="space-y-3 mb-6">
                <div>
                    <span class="text-gray-600">Created by:</span>
                    <span class="font-medium ml-2">{{ $artwork->user->name }}</span>
                </div>
                <div>
                    <span class="text-gray-600">Category:</span>
                    <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm ml-2">{{ $artwork->category->name }}</span>
                </div>
                <div>
                    <span class="text-gray-600">Price:</span>
                    <span class="text-2xl font-bold text-indigo-600 ml-2">${{ number_format($artwork->price, 2) }}</span>
                </div>
                <div>
                    <span class="text-gray-600">Downloads:</span>
                    <span class="font-medium ml-2">{{ $artwork->downloads }}</span>
                </div>
                <div>
                    <span class="text-gray-600">Uploaded:</span>
                    <span class="font-medium ml-2">{{ $artwork->created_at->format('M d, Y') }}</span>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="font-semibold mb-2">Description</h3>
                <p class="text-gray-700">{{ $artwork->description }}</p>
            </div>

            @if($artwork->orderItems->count() > 0)
                <div class="mb-6">
                    <h3 class="font-semibold mb-2">Sales History</h3>
                    <div class="bg-gray-50 rounded p-4">
                        <p class="text-gray-700">Total Sales: <span class="font-bold">{{ $artwork->orderItems->count() }}</span></p>
                        <p class="text-gray-700">Revenue: <span class="font-bold text-green-600">${{ number_format($artwork->orderItems->sum('price'), 2) }}</span></p>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.artworks.destroy', $artwork) }}" onsubmit="return confirm('Are you sure you want to delete this artwork?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 font-medium">
                    Delete Artwork
                </button>
            </form>
        </div>
    </div>
</div>
@endsection