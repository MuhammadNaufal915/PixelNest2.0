@extends('layouts.app')
@section('title', 'Edit User')
@section('content')
    <h1>Edit User</h1>
    <div
        style="max-width:600px;margin:2rem auto;background:#fff;padding:2rem;border-radius:1rem;box-shadow:0 4px 6px rgba(0,0,0,0.1)">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Name *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                @error('name')<span style="color:var(--danger);font-size:0.9rem">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Email *</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                @error('email')<span style="color:var(--danger);font-size:0.9rem">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>New Password (leave blank to keep current)</label>
                <input type="password" name="password" class="form-control">
                @error('password')<span style="color:var(--danger);font-size:0.9rem">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <div class="form-group">
                <label>Role *</label>
                <select name="role" class="form-control" required>
                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')<span style="color:var(--danger);font-size:0.9rem">{{ $message }}</span>@enderror
            </div>

            <div style="padding:1rem;background:#f8fafc;border-radius:0.5rem;margin:1rem 0">
                <strong>Account Info:</strong><br>
                Joined: {{ $user->created_at->format('d M Y') }}<br>
                Artworks: {{ $user->artworks->count() }}<br>
                Orders: {{ $user->orders->count() }}
            </div>

            <div style="display:flex;gap:1rem;margin-top:2rem">
                <button type="submit" class="btn btn-primary" style="flex:1">Update User</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline"
                    style="flex:1;text-align:center">Cancel</a>
            </div>
        </form>
    </div>
@endsection