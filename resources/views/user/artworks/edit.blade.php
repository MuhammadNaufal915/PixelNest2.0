@extends('layouts.app')
@section('title', 'Edit Artwork')
@section('styles')
<style>.form-container{max-width:800px;margin:2rem auto;background:#fff;padding:3rem;border-radius:1rem;box-shadow:0 10px 30px rgba(0,0,0,0.1)}.form-group{margin-bottom:2rem}.form-label{display:block;margin-bottom:0.5rem;font-weight:600}.form-input,.form-select,.form-textarea{width:100%;padding:0.75rem;border:2px solid var(--gray-light);border-radius:0.5rem;font-size:1rem}.form-input:focus,.form-select:focus,.form-textarea:focus{outline:none;border-color:var(--primary);box-shadow:0 0 0 3px rgba(99,102,241,0.1)}.form-textarea{min-height:150px;font-family:inherit}.preview-img{max-width:100%;max-height:300px;margin-top:1rem;border-radius:0.5rem}</style>
@endsection
@section('content')
<div class="form-container">
    <h1>Edit Artwork</h1>
    <div style="margin:1rem 0"><img src="{{ $artwork->image_url }}" style="max-width:300px;border-radius:0.5rem"></div>
    <form method="POST" action="{{ route('user.artworks.update', $artwork) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-label">Title *</label>
            <input type="text" name="title" class="form-input" value="{{ old('title', $artwork->title) }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Description *</label>
            <textarea name="description" class="form-textarea" required>{{ old('description', $artwork->description) }}</textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Category *</label>
            <select name="category_id" class="form-select" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $artwork->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Price (Rp) *</label>
            <input type="number" name="price" class="form-input" value="{{ old('price', $artwork->price) }}" min="0" step="1000" required>
        </div>
        <div class="form-group">
            <label class="form-label">New Preview Image (optional)</label>
            <input type="file" name="image" class="form-input" accept="image/*" onchange="previewImage(event)">
            <img id="imagePreview" class="preview-img" style="display:none">
        </div>
        <div class="form-group">
            <label class="form-label">New Download File (optional)</label>
            <input type="file" name="file" class="form-input">
            <small style="color:var(--gray)">Leave empty to keep current file</small>
        </div>
        <div style="display:flex;gap:1rem">
            <button type="submit" class="btn btn-primary" style="flex:1;padding:1rem">Update Artwork</button>
            <a href="{{ route('user.artworks.index') }}" class="btn btn-outline" style="padding:1rem">Cancel</a>
        </div>
    </form>
</div>
@endsection
@section('scripts')
<script>function previewImage(e){const preview=document.getElementById('imagePreview');const file=e.target.files[0];if(file){const reader=new FileReader();reader.onload=function(e){preview.src=e.target.result;preview.style.display='block'};reader.readAsDataURL(file)}}</script>
@endsection
