@extends('layouts.app')
@section('title', 'Create User')
@section('content')
<h1>Create New User</h1>
<div style="max-width:600px;margin:2rem auto;background:#fff;padding:2rem;border-radius:1rem;box-shadow:0 4px 6px rgba(0,0,0,0.1)">
    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        
        <div class="form-group">
            <label>Name *</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')<span style="color:var(--danger);font-size:0.9rem">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label>Email *</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            @error('email')<span style="color:var(--danger);font-size:0.9rem">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label>Password *</label>
            <input type="password" name="password" class="form-control" required>
            @error('password')<span style="color:var(--danger);font-size:0.9rem">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label>Confirm Password *</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Role *</label>
            <select name="role" class="form-control" required>
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role')<span style="color:var(--danger);font-size:0.9rem">{{ $message }}</span>@enderror
        </div>

        <div style="display:flex;gap:1rem;margin-top:2rem">
            <button type="submit" class="btn btn-primary" style="flex:1">Create User</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline" style="flex:1;text-align:center">Cancel</a>
        </div>
    </form>
</div>
@endsection
