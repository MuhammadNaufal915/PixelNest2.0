@extends('layouts.app')
<<<<<<< HEAD
@section('title', 'Admin Dashboard')
@section('styles')
    <style>
        .admin-header {
            background: var(--gradient);
            color: #fff;
            padding: 2rem;
            border-radius: 1rem;
            margin-bottom: 2rem
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0
        }

        .stat-card {
            background: #fff;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary)
        }

        .stat-label {
            color: var(--gray);
            margin-top: 0.5rem
        }

        .table-section {
            background: #fff;
            padding: 2rem;
            border-radius: 1rem;
            margin-top: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1)
        }

        .table {
            width: 100%;
            margin-top: 1rem
        }

        .table th {
            background: var(--dark);
            color: #fff;
            padding: 1rem;
            text-align: left
        }

        .table td {
            padding: 1rem;
            border-bottom: 1px solid var(--gray-light)
        }

        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.85rem
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e
        }

        .badge-success {
            background: #d1fae5;
            color: #065f46
        }
    </style>
@endsection
@section('content')
    <div class="admin-header">
        <h1>Admin Dashboard</h1>
        <p>Manage your marketplace</p>
    </div>
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-value">{{ $stats['total_users'] }}</div>
            <div class="stat-label">Total Users</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ $stats['total_artworks'] }}</div>
            <div class="stat-label">Total Artworks</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ $stats['pending_artworks'] }}</div>
            <div class="stat-label">Pending Approval</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ $stats['total_orders'] }}</div>
            <div class="stat-label">Total Orders</div>
        </div>
        <div class="stat-card" style="grid-column:span 2">
            <div class="stat-value">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</div>
            <div class="stat-label">Total Revenue</div>
        </div>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1rem;margin:2rem 0">
        <a href="{{ route('admin.artworks.index') }}" class="btn btn-primary" style="padding:1.5rem;text-align:center">📦
            Manage Artworks</a>
        <a href="{{ route('admin.users.index') }}" class="btn btn-primary" style="padding:1.5rem;text-align:center">👥
            Manage Users</a>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-primary" style="padding:1.5rem;text-align:center">🛒 View
            Orders</a>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-primary" style="padding:1.5rem;text-align:center">🏷️
            Manage Categories</a>
    </div>
    <div class="table-section">
        <h2>Pending Artworks</h2>
        @if($pendingArtworks->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Artist</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingArtworks as $artwork)
                        <tr>
                            <td>{{ $artwork->title }}</td>
                            <td>{{ $artwork->user->name }}</td>
                            <td>{{ $artwork->category->name }}</td>
                            <td>Rp {{ number_format($artwork->price, 0, ',', '.') }}</td>
                            <td><a href="{{ route('admin.artworks.show', $artwork) }}" class="btn btn-outline"
                                    style="padding:0.5rem 1rem">Review</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="text-align:center;color:var(--gray);padding:2rem">No pending artworks</p>
        @endif
    </div>
=======

@section('title', 'Admin Dashboard - PixelNest')

@section('content')
<div class="min-h-screen bg-black py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-white mb-2">Admin Dashboard</h1>
            <p class="text-zinc-400">Manage your platform with ease</p>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            {{-- Total Users --}}
            <div class="group bg-gradient-to-br from-zinc-900 via-zinc-800 to-zinc-900 border border-zinc-800 hover:border-zinc-700 rounded-2xl p-6 hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center transition-colors duration-300">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                    </div>
                    <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center opacity-50 group-hover:opacity-100 transition-opacity duration-300">
                        <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                </div>
                <div class="text-zinc-400 text-sm mb-1">Total Users</div>
                <div class="text-3xl font-bold text-white">{{ $usersCount ?? 0 }}</div>
            </div>

            {{-- Total Artworks --}}
            <div class="group bg-gradient-to-br from-zinc-900 via-zinc-800 to-zinc-900 border border-zinc-800 hover:border-zinc-700 rounded-2xl p-6 hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center transition-colors duration-300">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center opacity-50 group-hover:opacity-100 transition-opacity duration-300">
                        <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                </div>
                <div class="text-zinc-400 text-sm mb-1">Total Artworks</div>
                <div class="text-3xl font-bold text-white">{{ $artworksCount ?? 0 }}</div>
            </div>

            {{-- Total Orders --}}
            <div class="group bg-gradient-to-br from-zinc-900 via-zinc-800 to-zinc-900 border border-zinc-800 hover:border-zinc-700 rounded-2xl p-6 hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center transition-colors duration-300">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                        </svg>
                    </div>
                    <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center opacity-50 group-hover:opacity-100 transition-opacity duration-300">
                        <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                </div>
                <div class="text-zinc-400 text-sm mb-1">Total Orders</div>
                <div class="text-3xl font-bold text-white">{{ $ordersCount ?? 0 }}</div>
            </div>

            {{-- Total Revenue --}}
            <div class="group bg-gradient-to-br from-zinc-900 via-zinc-800 to-zinc-900 border border-zinc-800 hover:border-zinc-700 rounded-2xl p-6 hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center transition-colors duration-300">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center opacity-50 group-hover:opacity-100 transition-opacity duration-300">
                        <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                </div>
                <div class="text-zinc-400 text-sm mb-1">Total Revenue</div>
                <div class="text-3xl font-bold text-white">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</div>
            </div>
        </div>

        {{-- Recent Data --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            {{-- Recent Orders --}}
            <div class="bg-gradient-to-br from-zinc-900 via-zinc-800 to-zinc-900 border border-zinc-800 rounded-2xl p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-white mb-1">Recent Orders</h2>
                        <p class="text-sm text-zinc-400">Latest customer purchases</p>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="group inline-flex items-center gap-2 px-4 py-2 bg-white/5 hover:bg-white/10 rounded-full text-sm text-zinc-400 hover:text-white transition-all duration-200">
                        View All
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                @if(isset($recentOrders) && $recentOrders->count() > 0)
                    <div class="space-y-3">
                        @foreach($recentOrders as $order)
                            <div class="group flex items-center justify-between p-4 bg-zinc-800/50 hover:bg-zinc-800 rounded-xl transition-all duration-200 border border-transparent hover:border-zinc-700">
                                <div>
                                    <div class="font-semibold text-white mb-1">{{ $order->order_number }}</div>
                                    <div class="text-sm text-zinc-400">{{ $order->user->name ?? 'Unknown' }}</div>
                                    <div class="text-xs text-zinc-500 mt-1">{{ $order->created_at->diffForHumans() }}</div>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold text-white text-lg">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-white/5 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                        </div>
                        <p class="text-zinc-400">No orders yet</p>
                    </div>
                @endif
            </div>

            {{-- Recent Artworks --}}
            <div class="bg-gradient-to-br from-zinc-900 via-zinc-800 to-zinc-900 border border-zinc-800 rounded-2xl p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-white mb-1">Recent Artworks</h2>
                        <p class="text-sm text-zinc-400">Newly added products</p>
                    </div>
                    <a href="{{ route('admin.artworks.index') }}" class="group inline-flex items-center gap-2 px-4 py-2 bg-white/5 hover:bg-white/10 rounded-full text-sm text-zinc-400 hover:text-white transition-all duration-200">
                        View All
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                @if(isset($recentArtworks) && $recentArtworks->count() > 0)
                    <div class="space-y-3">
                        @foreach($recentArtworks as $artwork)
                            <div class="group flex items-center gap-4 p-4 bg-zinc-800/50 hover:bg-zinc-800 rounded-xl transition-all duration-200 border border-transparent hover:border-zinc-700">
                                <div class="w-16 h-16 bg-gradient-to-br from-zinc-700 via-zinc-800 to-black rounded-xl overflow-hidden flex-shrink-0">
                                    @if($artwork->image_path)
                                        <img src="/storage/{{ $artwork->image_path }}" alt="{{ $artwork->title }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-8 h-8 text-zinc-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="font-semibold text-white truncate">{{ $artwork->title }}</div>
                                    <div class="text-sm text-zinc-400">by {{ $artwork->user->name ?? 'Unknown' }}</div>
                                </div>
                                <div class="font-bold text-white">Rp {{ number_format($artwork->price, 0, ',', '.') }}</div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-white/5 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-zinc-600" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <p class="text-zinc-400">No artworks yet</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-gradient-to-br from-zinc-900 via-zinc-800 to-zinc-900 border border-zinc-800 rounded-2xl p-6">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-white mb-1">Quick Actions</h2>
                <p class="text-sm text-zinc-400">Manage your platform efficiently</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('admin.artworks.index') }}" class="group bg-zinc-800/50 hover:bg-zinc-800 border border-zinc-700 hover:border-zinc-600 rounded-xl p-6 transition-all duration-200 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center mb-4 transition-colors duration-200">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">Manage Artworks</h3>
                    <p class="text-sm text-zinc-400">View and manage all artworks</p>
                </a>

                <a href="{{ route('admin.categories.index') }}" class="group bg-zinc-800/50 hover:bg-zinc-800 border border-zinc-700 hover:border-zinc-600 rounded-xl p-6 transition-all duration-200 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center mb-4 transition-colors duration-200">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">Manage Categories</h3>
                    <p class="text-sm text-zinc-400">Organize artwork categories</p>
                </a>

                <a href="{{ route('admin.orders.index') }}" class="group bg-zinc-800/50 hover:bg-zinc-800 border border-zinc-700 hover:border-zinc-600 rounded-xl p-6 transition-all duration-200 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center mb-4 transition-colors duration-200">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">View Orders</h3>
                    <p class="text-sm text-zinc-400">Track all customer orders</p>
                </a>
            </div>
        </div>
    </div>
</div>
>>>>>>> 6c9d1f181de761f38531d11c96559cf0ad585280
@endsection