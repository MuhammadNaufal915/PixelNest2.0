@extends('layouts.app')
@section('title', 'My Artworks')
@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem">
    <h1>My Artworks</h1>
    <a href="{{ route('user.artworks.create') }}" class="btn btn-primary">Upload New</a>
</div>
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:2rem">
    @forelse($artworks as $artwork)
        <div style="background:#fff;border-radius:1rem;overflow:hidden;box-shadow:0 4px 6px rgba(0,0,0,0.1)">
            <img src="{{ $artwork->image_url }}" style="width:100%;height:200px;object-fit:cover">
            <div style="padding:1.5rem">
                <h3>{{ $artwork->title }}</h3>
                <p style="color:var(--gray);margin:0.5rem 0">{{ $artwork->category->name }}</p>
                <p style="font-weight:700;color:var(--primary);font-size:1.2rem">Rp {{ number_format($artwork->price, 0, ',', '.') }}</p>
                <div style="margin-top:1rem;display:flex;gap:0.5rem;flex-wrap:wrap">
                    <span class="badge badge-{{ $artwork->status === 'approved' ? 'success' : ($artwork->status === 'pending' ? 'warning' : 'danger') }}">{{ ucfirst($artwork->status) }}</span>
                    @if($artwork->is_active)<span class="badge badge-success">Active</span>@else<span class="badge badge-danger">Inactive</span>@endif
                </div>
                <div style="margin-top:1rem;display:flex;gap:0.5rem">
                    <form method="POST" action="{{ route('user.artworks.toggle', $artwork) }}" style="flex:1">
                        @csrf
                        <button type="submit" class="btn btn-outline" style="width:100%">{{ $artwork->is_active ? 'Deactivate' : 'Activate' }}</button>
                    </form>
                    <a href="{{ route('user.artworks.edit', $artwork) }}" class="btn btn-outline">Edit</a>
                    <form method="POST" action="{{ route('user.artworks.destroy', $artwork) }}" onsubmit="return confirm('Delete this artwork?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn" style="background:var(--danger);color:#fff">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div style="grid-column:1/-1;text-align:center;padding:4rem;color:var(--gray)">
            <h2>No artworks yet</h2>
            <a href="{{ route('user.artworks.create') }}" class="btn btn-primary" style="margin-top:1rem">Upload Your First Artwork</a>
        </div>
    @endforelse
</div>
@endsection
