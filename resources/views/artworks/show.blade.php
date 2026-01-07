@extends('layouts.app')
@section('title', $artwork->title)
@section('styles')
<style>.detail-container{display:grid;grid-template-columns:2fr 1fr;gap:3rem;margin-top:2rem}.artwork-image{width:100%;border-radius:1rem;box-shadow:0 20px 60px rgba(0,0,0,0.15)}.artwork-info{background:#fff;padding:2rem;border-radius:1rem;height:fit-content}.price-tag{font-size:2rem;font-weight:800;color:var(--primary);margin:1rem 0}.info-section{margin:2rem 0;padding:2rem 0;border-top:1px solid var(--gray-light)}.related-title{font-size:2rem;margin:4rem 0 2rem}.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(250px,1fr));gap:2rem}.card{background:#fff;border-radius:1rem;overflow:hidden;box-shadow:0 4px 6px rgba(0,0,0,0.1);transition:all 0.3s}.card:hover{transform:translateY(-5px)}.card-img{width:100%;height:200px;object-fit:cover}.card-body{padding:1rem}</style>
@endsection
@section('content')
<div class="detail-container">
    <div><img src="{{ $artwork->image_url }}" alt="{{ $artwork->title }}" class="artwork-image"></div>
    <div class="artwork-info">
        <span style="color:var(--gray);font-size:0.9rem">{{ $artwork->category->name }}</span>
        <h1>{{ $artwork->title }}</h1>
        <p style="color:var(--gray);margin:1rem 0">by {{ $artwork->user->name }}</p>
        <div class="price-tag">Rp {{ number_format($artwork->price, 0, ',', '.') }}</div>
        @auth
            @if(auth()->id() !== $artwork->user_id)
                <form method="POST" action="{{ route('cart.add', $artwork) }}">
                    @csrf
                    <button type="submit" class="btn btn-primary" style="width:100%;padding:1rem">Add to Cart</button>
                </form>
            @endif
        @else
            <a href="{{ route('login') }}" class="btn btn-primary" style="width:100%;padding:1rem;text-align:center;display:block">Login to Purchase</a>
        @endauth
        <div class="info-section">
            <h3>Description</h3>
            <p style="color:var(--gray);line-height:1.8">{{ $artwork->description }}</p>
        </div>
        <div style="color:var(--gray);font-size:0.9rem">Downloads: {{ $artwork->downloads_count }}</div>
    </div>
</div>
<h2 class="related-title">Related Artworks</h2>
<div class="grid">
    @foreach($relatedArtworks as $item)
        <a href="{{ route('artworks.show', $item) }}" style="text-decoration:none;color:inherit">
            <div class="card">
                <img src="{{ $item->image_url }}" class="card-img">
                <div class="card-body">
                    <h4>{{ $item->title }}</h4>
                    <p style="color:var(--primary);font-weight:700">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                </div>
            </div>
        </a>
    @endforeach
</div>
@endsection
