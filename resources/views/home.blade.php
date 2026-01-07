@extends('layouts.app')

@section('title', 'Explore Creative Designs - PixelNest')

@section('styles')
<style>
.hero{background:var(--gradient);color:#fff;padding:4rem 2rem;text-align:center;margin-bottom:3rem}.hero h1{font-size:3rem;margin-bottom:1rem}.hero p{font-size:1.2rem;opacity:0.9}.search-bar{max-width:600px;margin:2rem auto;display:flex;gap:1rem}.search-input{flex:1;padding:1rem;border:none;border-radius:0.5rem;font-size:1rem}.categories{display:flex;gap:1rem;margin-bottom:2rem;overflow-x:auto;padding:1rem 0}.category-tag{padding:0.5rem 1.5rem;background:#fff;border-radius:2rem;border:2px solid var(--gray-light);cursor:pointer;white-space:nowrap;transition:all 0.3s}.category-tag:hover,.category-tag.active{border-color:var(--primary);background:var(--primary);color:#fff}.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:2rem;margin-top:2rem}.card{background:#fff;border-radius:1rem;overflow:hidden;box-shadow:0 4px 6px rgba(0,0,0,0.1);transition:all 0.3s;cursor:pointer}.card:hover{transform:translateY(-8px);box-shadow:0 20px 40px rgba(0,0,0,0.15)}.card-image{width:100%;height:250px;object-fit:cover}.card-content{padding:1.5rem}.card-title{font-size:1.2rem;margin-bottom:0.5rem;font-weight:700}.card-desc{color:var(--gray);font-size:0.9rem;margin-bottom:1rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}.card-footer{display:flex;justify-content:space-between;align-items:center;padding-top:1rem;border-top:1px solid var(--gray-light)}.card-price{font-size:1.3rem;font-weight:700;color:var(--primary)}.card-author{font-size:0.9rem;color:var(--gray)}.pagination{display:flex;justify-content:center;gap:0.5rem;margin-top:3rem}.pagination a,.pagination span{padding:0.5rem 1rem;border-radius:0.5rem;text-decoration:none;color:var(--dark);background:#fff;border:2px solid var(--gray-light)}.pagination .active{background:var(--primary);color:#fff;border-color:var(--primary)}
</style>
@endsection

@section('content')
<div class="hero">
    <h1>Discover Amazing Designs</h1>
    <p>Browse thousands of creative works from talented designers</p>
    <form method="GET" action="{{ route('home') }}" class="search-bar">
        <input type="text" name="search" class="search-input" placeholder="Search designs..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>

<div class="categories">
    <a href="{{ route('home') }}" class="category-tag {{ !request('category') ? 'active' : '' }}">All</a>
    @foreach($categories as $category)
        <a href="{{ route('home', ['category' => $category->id]) }}" class="category-tag {{ request('category') == $category->id ? 'active' : '' }}">
            {{ $category->name }} ({{ $category->artworks_count }})
        </a>
    @endforeach
</div>

<div class="grid">
    @forelse($artworks as $artwork)
        <a href="{{ route('artworks.show', $artwork) }}" style="text-decoration:none;color:inherit">
            <div class="card">
                <img src="{{ $artwork->image_url }}" alt="{{ $artwork->title }}" class="card-image">
                <div class="card-content">
                    <h3 class="card-title">{{ $artwork->title }}</h3>
                    <p class="card-desc">{{ Str::limit($artwork->description, 100) }}</p>
                    <div class="card-footer">
                        <span class="card-price">Rp {{ number_format($artwork->price, 0, ',', '.') }}</span>
                        <span class="card-author">by {{ $artwork->user->name }}</span>
                    </div>
                </div>
            </div>
        </a>
    @empty
        <div style="grid-column:1/-1;text-align:center;padding:4rem;color:var(--gray)">
            <h2>No artworks found</h2>
            <p>Try different search terms or categories</p>
        </div>
    @endforelse
</div>

<div class="pagination">
    {{ $artworks->links() }}
</div>
@endsection
