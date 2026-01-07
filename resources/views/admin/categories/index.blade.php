@extends('layouts.app')
@section('title', 'Manage Categories')
@section('content')
<h1>Manage Categories</h1>
<div style="display:grid;grid-template-columns:1fr 2fr;gap:2rem;margin-top:2rem">
    <div style="background:#fff;padding:2rem;border-radius:1rem;box-shadow:0 4px 6px rgba(0,0,0,0.1)">
        <h2>Add Category</h2>
        <form method="POST" action="{{ route('admin.categories.store') }}" style="margin-top:1.5rem">
            @csrf
            <div style="margin-bottom:1rem"><label style="display:block;margin-bottom:0.5rem;font-weight:600">Name</label><input type="text" name="name" class="form-input" required></div>
            <div style="margin-bottom:1rem"><label style="display:block;margin-bottom:0.5rem;font-weight:600">Description</label><textarea name="description" class="form-textarea" style="min-height:100px"></textarea></div>
            <button type="submit" class="btn btn-primary" style="width:100%">Add Category</button>
        </form>
    </div>
    <div style="background:#fff;padding:2rem;border-radius:1rem;box-shadow:0 4px 6px rgba(0,0,0,0.1)">
        <h2>Categories</h2>
        <table class="table" style="margin-top:1.5rem">
            <thead><tr><th>Name</th><th>Artworks</th><th>Actions</th></tr></thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td><strong>{{ $category->name }}</strong><br><small style="color:var(--gray)">{{ $category->description }}</small></td>
                        <td>{{ $category->artworks_count }}</td>
                        <td><form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn" style="background:var(--danger);color:#fff;padding:0.5rem 1rem">Delete</button></form></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
