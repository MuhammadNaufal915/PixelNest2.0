@extends('layouts.app')
@section('title', 'Create Artwork')
@section('content')
    <h1>Create New Artwork</h1>
    <div
        style="max-width:800px;margin:2rem auto;background:#fff;padding:2rem;border-radius:1rem;box-shadow:0 4px 6px rgba(0,0,0,0.1)">
        <form method="POST" action="{{ route('admin.artworks.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Artist *</label>
                <select name="user_id" class="form-control" required>
                    <option value="">Select Artist</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}
                            ({{ $user->email }})</option>
                    @endforeach
                </select>
                @error('user_id')<span style="color:var(--danger);font-size:0.9rem">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Category *</label>
                <select name="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')<span style="color:var(--danger);font-size:0.9rem">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Title *</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                @error('title')<span style="color:var(--danger);font-size:0.9rem">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Description *</label>
                <textarea name="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
                @error('description')<span style="color:var(--danger);font-size:0.9rem">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Price (Rp) *</label>
                <input type="number" name="price" class="form-control" value="{{ old('price') }}" min="0" step="1000"
                    required>
                @error('price')<span style="color:var(--danger);font-size:0.9rem">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Preview Image * (Max 5MB)</label>
                <input type="file" name="image" class="form-control" accept="image/*" required>
                @error('image')<span style="color:var(--danger);font-size:0.9rem">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Download File * (Max 50MB)</label>
                <input type="file" name="file" class="form-control" required>
                @error('file')<span style="color:var(--danger);font-size:0.9rem">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Status *</label>
                <select name="status" class="form-control" required>
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ old('status', 'approved') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
                @error('status')<span style="color:var(--danger);font-size:0.9rem">{{ $message }}</span>@enderror
            </div>

            <div style="display:flex;gap:1rem;margin-top:2rem">
                <button type="submit" class="btn btn-primary" style="flex:1">Create Artwork</button>
                <a href="{{ route('admin.artworks.index') }}" class="btn btn-outline"
                    style="flex:1;text-align:center">Cancel</a>
            </div>
        </form>
    </div>
@endsection