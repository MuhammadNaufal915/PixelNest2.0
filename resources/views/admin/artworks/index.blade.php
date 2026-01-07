@extends('layouts.app')
@section('title', 'Manage Artworks')
@section('content')
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
@endsection