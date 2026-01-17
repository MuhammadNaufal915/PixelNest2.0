@extends('layouts.app')
@section('title', 'Manage Users')
@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem">
        <h1>Manage Users</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">+ Create New User</a>
    </div>
    <div style="background:#fff;border-radius:1rem;padding:2rem;box-shadow:0 4px 6px rgba(0,0,0,0.1)">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Artworks</th>
                    <th>Orders</th>
                    <th>Joined</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge badge-{{ $user->role === 'admin' ? 'danger' : 'success' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td>{{ $user->artworks->count() }}</td>
                        <td>{{ $user->orders->count() }}</td>
                        <td>{{ $user->created_at->format('d M Y') }}</td>
                        <td style="display:flex;gap:0.5rem">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary"
                                style="padding:0.5rem 1rem">Edit</a>
                            @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                    onsubmit="return confirm('Delete this user?')">
                                    @csrf @method('DELETE')
                                    <button class="btn" style="background:var(--danger);color:#fff;padding:0.5rem 1rem">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
@endsection