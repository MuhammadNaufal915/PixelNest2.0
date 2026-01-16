@extends('layouts.app')

@section('title', $artwork->title . ' - PixelNest')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div>
            <img src="{{ asset('storage/' . $artwork->image_path) }}" alt="{{ $artwork->title }}" class="w-full rounded-lg shadow-lg">
        </div>

        <div>
            <div class="bg-white rounded-lg shadow-md p-8">
                <h1 class="text-3xl font-bold mb-4">{{ $artwork->title }}</h1>
                
                <div class="flex items-center mb-4">
                    <span class="text-gray-600">by</span>
                    <span class="ml-2 font-medium">{{ $artwork->user->name }}</span>
                </div>

                <div class="mb-4">
                    <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm">{{ $artwork->category->name }}</span>
                </div>

                <div class="mb-6">
                    <p class="text-gray-700">{{ $artwork->description }}</p>
                </div>

                <div class="mb-6">
                    <div class="text-4xl font-bold text-indigo-600">${{ number_format($artwork->price, 2) }}</div>
                    <div class="text-gray-500 text-sm mt-1">{{ $artwork->downloads }} downloads</div>
                </div>

                @auth
                    @if(auth()->id() !== $artwork->user_id)
                        @if(!auth()->user()->isBanned())
                            <form method="POST" action="{{ route('cart.add', $artwork) }}">
                                @csrf
                                <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 font-medium text-lg">
                                    Add to Cart
                                </button>
                            </form>
                        @else
                            <div class="bg-red-100 text-red-700 px-4 py-3 rounded">
                                Your account is banned and cannot make purchases.
                            </div>
                        @endif
                    @else
                        <div class="bg-gray-100 text-gray-700 px-4 py-3 rounded text-center">
                            This is your artwork
                        </div>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="block text-center w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 font-medium text-lg">
                        Login to Purchase
                    </a>
                @endauth
            </div>
        </div>
    </div>

    @if($relatedArtworks->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-6">Related Artworks</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @foreach($relatedArtworks as $related)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="{{ asset('storage/' . $related->image_path) }}" alt="{{ $related->title }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="font-semibold mb-2">{{ $related->title }}</h3>
                            <p class="text-indigo-600 font-bold mb-3">${{ number_format($related->price, 2) }}</p>
                            <a href="{{ route('artworks.show', $related) }}" class="block text-center bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 text-sm">
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection