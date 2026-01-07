@extends('layouts.app')
@section('title', 'Upload Artwork')
@section('styles')
<style>.form-container{max-width:800px;margin:2rem auto;background:#fff;padding:3rem;border-radius:1rem;box-shadow:0 10px 30px rgba(0,0,0,0.1)}.form-group{margin-bottom:2rem}.form-label{display:block;margin-bottom:0.5rem;font-weight:600}.form-input,.form-select,.form-textarea{width:100%;padding:0.75rem;border:2px solid var(--gray-light);border-radius:0.5rem;font-size:1rem}.form-input:focus,.form-select:focus,.form-textarea:focus{outline:none;border-color:var(--primary);box-shadow:0 0 0 3px rgba(99,102,241,0.1)}.form-textarea{min-height:150px;font-family:inherit}.upload-area{border:3px dashed var(--gray-light);border-radius:1rem;padding:3rem;text-align:center;cursor:pointer;transition:all 0.3s}.upload-area:hover{border-color:var(--primary);background:rgba(99,102,241,0.05)}.preview-img{max-width:100%;max-height:300px;margin-top:1rem;border-radius:0.5rem}</style>
@endsection
@section('content')
<div class="form-container">
    <h1>Upload New Artwork</h1>
    <p style="color:var(--gray);margin-bottom:2rem">Share your creative work with the community</p>
    <form method="POST" action="{{ route('user.artworks.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="form-label">Title *</label>
            <input type="text" name="title" class="form-input" value="{{ old('title') }}" required>
            @error('title')<div style="color:var(--danger);font-size:0.875rem;margin-top:0.5rem">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label class="form-label">Description *</label>
            <textarea name="description" class="form-textarea" required>{{ old('description') }}</textarea>
            @error('description')<div style="color:var(--danger);font-size:0.875rem;margin-top:0.5rem">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label class="form-label">Category *</label>
            <select name="category_id" class="form-select" required>
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')<div style="color:var(--danger);font-size:0.875rem;margin-top:0.5rem">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label class="form-label">Price (Rp) *</label>
            <input type="number" name="price" class="form-input" value="{{ old('price') }}" min="0" step="1000" required>
            @error('price')<div style="color:var(--danger);font-size:0.875rem;margin-top:0.5rem">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label class="form-label">Preview Image * (Max 5MB)</label>
            <input type="file" name="image" class="form-input" accept="image/*" required onchange="previewImage(event)">
            <img id="imagePreview" class="preview-img" style="display:none">
            @error('image')<div style="color:var(--danger);font-size:0.875rem;margin-top:0.5rem">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label class="form-label">Download File * (Max 50MB)</label>
            <input type="file" name="file" class="form-input" required>
            <small style="color:var(--gray)">Upload the actual file customers will download</small>
            @error('file')<div style="color:var(--danger);font-size:0.875rem;margin-top:0.5rem">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%;padding:1rem;font-size:1.1rem">Upload Artwork</button>
    </form>
</div>
@endsection
@section('scripts')
<script>function previewImage(e){const preview=document.getElementById('imagePreview');const file=e.target.files[0];if(file){const reader=new FileReader();reader.onload=function(e){preview.src=e.target.result;preview.style.display='block'};reader.readAsDataURL(file)}}</script>
@endsection
