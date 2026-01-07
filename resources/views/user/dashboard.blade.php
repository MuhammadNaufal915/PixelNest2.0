@extends('layouts.app')
@section('title', 'User Dashboard')
@section('styles')
<style>.stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:2rem;margin:2rem 0}.stat-card{background:#fff;padding:2rem;border-radius:1rem;box-shadow:0 4px 6px rgba(0,0,0,0.1)}.stat-value{font-size:2.5rem;font-weight:800;background:var(--gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent}.stat-label{color:var(--gray);margin-top:0.5rem}.section{margin:3rem 0}.section-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem}.table{width:100%;background:#fff;border-radius:1rem;overflow:hidden;box-shadow:0 4px 6px rgba(0,0,0,0.1)}.table th{background:var(--dark);color:#fff;padding:1rem;text-align:left}.table td{padding:1rem;border-bottom:1px solid var(--gray-light)}.badge{padding:0.25rem 0.75rem;border-radius:1rem;font-size:0.85rem;font-weight:600}.badge-success{background:#d1fae5;color:#065f46}.badge-warning{background:#fef3c7;color:#92400e}.badge-danger{background:#fee2e2;color:#991b1b}</style>
@endsection
@section('content')
<h1>Dashboard</h1>
<div class="stats-grid">
    <div class="stat-card"><div class="stat-value">{{ $stats['total_artworks'] }}</div><div class="stat-label">Total Artworks</div></div>
    <div class="stat-card"><div class="stat-value">{{ $stats['approved_artworks'] }}</div><div class="stat-label">Approved</div></div>
    <div class="stat-card"><div class="stat-value">Rp {{ number_format($stats['total_sales'], 0, ',', '.') }}</div><div class="stat-label">Total Sales</div></div>
    <div class="stat-card"><div class="stat-value">{{ $stats['total_purchases'] }}</div><div class="stat-label">Purchases</div></div>
</div>
<div class="section">
    <div class="section-header"><h2>Recent Artworks</h2><a href="{{ route('user.artworks.index') }}" class="btn btn-outline">View All</a></div>
    @if($recentArtworks->count() > 0)
        <table class="table">
            <thead><tr><th>Title</th><th>Category</th><th>Price</th><th>Status</th></tr></thead>
            <tbody>
                @foreach($recentArtworks as $artwork)
                    <tr>
                        <td>{{ $artwork->title }}</td>
                        <td>{{ $artwork->category->name }}</td>
                        <td>Rp {{ number_format($artwork->price, 0, ',', '.') }}</td>
                        <td><span class="badge badge-{{ $artwork->status === 'approved' ? 'success' : ($artwork->status === 'pending' ? 'warning' : 'danger') }}">{{ ucfirst($artwork->status) }}</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="text-align:center;color:var(--gray);padding:2rem">No artworks yet. <a href="{{ route('user.artworks.create') }}">Upload your first artwork!</a></p>
    @endif
</div>
@endsection
