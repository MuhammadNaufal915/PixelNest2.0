@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('styles')
<style>.admin-header{background:var(--gradient);color:#fff;padding:2rem;border-radius:1rem;margin-bottom:2rem}.stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1.5rem;margin:2rem 0}.stat-card{background:#fff;padding:2rem;border-radius:1rem;box-shadow:0 4px 6px rgba(0,0,0,0.1);text-align:center}.stat-value{font-size:2.5rem;font-weight:800;color:var(--primary)}.stat-label{color:var(--gray);margin-top:0.5rem}.table-section{background:#fff;padding:2rem;border-radius:1rem;margin-top:2rem;box-shadow:0 4px 6px rgba(0,0,0,0.1)}.table{width:100%;margin-top:1rem}.table th{background:var(--dark);color:#fff;padding:1rem;text-align:left}.table td{padding:1rem;border-bottom:1px solid var(--gray-light)}.badge{padding:0.25rem 0.75rem;border-radius:1rem;font-size:0.85rem}.badge-warning{background:#fef3c7;color:#92400e}.badge-success{background:#d1fae5;color:#065f46}</style>
@endsection
@section('content')
<div class="admin-header"><h1>Admin Dashboard</h1><p>Manage your marketplace</p></div>
<div class="stats-grid">
    <div class="stat-card"><div class="stat-value">{{ $stats['total_users'] }}</div><div class="stat-label">Total Users</div></div>
    <div class="stat-card"><div class="stat-value">{{ $stats['total_artworks'] }}</div><div class="stat-label">Total Artworks</div></div>
    <div class="stat-card"><div class="stat-value">{{ $stats['pending_artworks'] }}</div><div class="stat-label">Pending Approval</div></div>
    <div class="stat-card"><div class="stat-value">{{ $stats['total_orders'] }}</div><div class="stat-label">Total Orders</div></div>
    <div class="stat-card" style="grid-column:span 2"><div class="stat-value">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</div><div class="stat-label">Total Revenue</div></div>
</div>
<div class="table-section">
    <h2>Pending Artworks</h2>
    @if($pendingArtworks->count() > 0)
        <table class="table">
            <thead><tr><th>Title</th><th>Artist</th><th>Category</th><th>Price</th><th>Action</th></tr></thead>
            <tbody>
                @foreach($pendingArtworks as $artwork)
                    <tr>
                        <td>{{ $artwork->title }}</td>
                        <td>{{ $artwork->user->name }}</td>
                        <td>{{ $artwork->category->name }}</td>
                        <td>Rp {{ number_format($artwork->price, 0, ',', '.') }}</td>
                        <td><a href="{{ route('admin.artworks.show', $artwork) }}" class="btn btn-outline" style="padding:0.5rem 1rem">Review</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="text-align:center;color:var(--gray);padding:2rem">No pending artworks</p>
    @endif
</div>
@endsection
