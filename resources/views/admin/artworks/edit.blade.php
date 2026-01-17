@extends('layouts.app')
@section('title', 'Edit Artwork')
@section('content')
    <h1>Edit Artwork</h1>
    <div
        style="max-width:800px;margin:2rem auto;background:#fff;padding:2rem;border-radius:1rem;box-shadow:0 4px 6px rgba(0,0,0,0.1)">
        <form method="POST" action="{{ route('admin.artworks.update', $artwork) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Artist *</label>
                <select name="user_id" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ (old('user_id', $artwork->user_id) == $user->id) ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
                @error('user_id')<span style="color:var(--danger);font-size:0.9rem">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Category *</label>
                <select name="category_id" class="form-control" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (old('category_id', $artwork->category_id) == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')<span style="color:var(--danger);font-size:0.9rem">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Title *</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $artwork->title) }}" required>
                @error('title')<span style="color:var(--danger);font-size:0.9rem">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Description *</label>
                <textarea name="description" class="form-control" rows="5"
                    required>{{ old('description', $artwork->description) }}</textarea>
                @error('description')<span style="color:var(--danger);font-size:0.9rem">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Price (Rp) *</label>
                <input type="number" name="price" class="form-control" value="{{ old('price', $artwork->price) }}" min="0"
                    step="1000" required>
                @error('price')<span style="color:var(--danger);font-size:0.9rem">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Current Preview Image</label>
                <div><img src="{{ $artwork->image_url }}" style="max-width:300px;border-radius:0.5rem;margin:1rem 0"></div>
                <label>Change Preview Image (Optional, Max 5MB)</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                @error('image')<span style="color:var(--danger);font-size:0.9rem">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Current Download File</label>
                <div style="padding:1rem;background:#f8fafc;border-radius:0.5rem;margin:1rem 0">
                    {{ basename($artwork->file_path) }}
                </div>
                <label>Change Download File (Optional, Max 50MB)</label>
                <input type="file" name="file" class="form-control">
                @error('file')<span style="color:var(--danger);font-size:0.9rem">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Status *</label>
                <select name="status" class="form-control" required>
                    <option value="pending" {{ old('status', $artwork->status) == 'pending' ? 'selected' : '' }}>Pending
                    </option>
                    <option value="approved" {{ old('status', $artwork->status) == 'approved' ? 'selected' : '' }}>Approved
                    </option>
                    <option value="rejected" {{ old('status', $artwork->status) == 'rejected' ? 'selected' : '' }}>Rejected
                    </option>
                </select>
                @error('status')<span style="color:var(--danger);font-size:0.9rem">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $artwork->is_active) ? 'checked' : '' }}>
                    Active
                </label>
            </div>

            <div style="display:flex;gap:1rem;margin-top:2rem">
                <button type="submit" class="btn btn-primary" style="flex:1">Update Artwork</button>
                <a href="{{ route('admin.artworks.index') }}" class="btn btn-outline"
                    style="flex:1;text-align:center">Cancel</a>
            </div>
        </form>
    </div>
@endsection