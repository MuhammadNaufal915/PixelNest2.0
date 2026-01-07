@extends('layouts.app')
@section('title', 'Review Artwork')
@section('content')
<h1>Review Artwork</h1>
<div style="display:grid;grid-template-columns:2fr 1fr;gap:2rem;margin-top:2rem">
    <div><img src="{{ $artwork->image_url }}" style="width:100%;border-radius:1rem;box-shadow:0 10px 30px rgba(0,0,0,0.1)"></div>
    <div style="background:#fff;padding:2rem;border-radius:1rem;box-shadow:0 4px 6px rgba(0,0,0,0.1);height:fit-content">
        <span class="badge badge-{{ $artwork->status === 'approved' ? 'success' : ($artwork->status === 'pending' ? 'warning' : 'danger') }}">{{ ucfirst($artwork->status) }}</span>
        <h2style="margin-top:1rem">{{ $artwork->title }}</h2>
        <p style="color:var(--gray)">by {{ $artwork->user->name }}</p>
        <p style="color:var(--gray);margin-top:0.5rem"><strong>Category:</strong> {{ $artwork->category->name }}</p>
        <p style="font-size:2rem;font-weight:700;color:var(--primary);margin:1rem 0">Rp {{ number_format($artwork->price, 0, ',', '.') }}</p>
        <div style="margin:2rem 0"><h3>Description</h3><p style="color:var(--gray);line-height:1.8">{{ $artwork->description }}</p></div>
        @if($artwork->status !== 'approved')
            <form method="POST" action="{{ route('admin.artworks.approve', $artwork) }}" style="margin-bottom:1rem">@csrf<button class="btn btn-primary" style="width:100%;padding:1rem">Approve</button></form>
        @endif
        @if($artwork->status !== 'rejected')
            <form method="POST" action="{{ route('admin.artworks.reject', $artwork) }}">@csrf<button class="btn" style="width:100%;padding:1rem;background:var(--danger);color:#fff">Reject</button></form>
        @endif
    </div>
</div>
@endsection
