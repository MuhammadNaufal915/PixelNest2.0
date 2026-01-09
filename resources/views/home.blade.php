@extends('layouts.app')

@section('title', 'Explore Creative Designs - PixelNest')

@section('styles')
    <style>
        /* Modern Hero Section */
        .hero-section {
            position: relative;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #db2777 100%);
            border-radius: 1.5rem;
            padding: 4rem 2rem;
            color: white;
            text-align: center;
            overflow: hidden;
            margin-bottom: 3rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .hero-bg-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.6;
        }

        .shape-1 {
            width: 400px;
            height: 400px;
            background: #60a5fa;
            top: -100px;
            left: -100px;
        }

        .shape-2 {
            width: 300px;
            height: 300px;
            background: #f472b6;
            bottom: -50px;
            right: -50px;
        }

        .hero-content {
            position: relative;
            z-index: 10;
            max-width: 800px;
            margin: 0 auto;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            letter-spacing: -0.025em;
            line-height: 1.1;
            text-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2.5rem;
            font-weight: 400;
        }

        /* Glassmorphism Search Bar */
        .search-container {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 1rem;
            padding: 0.5rem;
            display: flex;
            gap: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            max-width: 600px;
            margin: 0 auto;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .search-container:focus-within {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            background: rgba(255, 255, 255, 0.25);
        }

        .search-input {
            flex: 1;
            background: transparent;
            border: none;
            padding: 1rem 1.5rem;
            color: white;
            font-size: 1.1rem;
            outline: none;
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .search-btn {
            background: white;
            color: #4f46e5;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .search-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.3);
        }

        /* Categories */
        .categories-wrapper {
            margin-bottom: 3rem;
            overflow-x: auto;
            padding-bottom: 1rem;
        }

        .categories-list {
            display: flex;
            gap: 1rem;
            justify-content: flex-start; /* Changed for scrollability */
            min-width: max-content;
        }

        .category-pill {
            padding: 0.75rem 1.5rem;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 50px;
            color: #64748b;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        .category-pill:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border-color: #6366f1;
            color: #6366f1;
        }

        .category-pill.active {
            background: #4f46e5;
            color: white;
            border-color: #4f46e5;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3);
        }

        /* Filters Bar */
        .filters-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            background: white;
            padding: 1rem 1.5rem;
            border-radius: 1rem;
            border: 1px solid #f1f5f9;
        }

        .result-count {
            color: #64748b;
            font-weight: 500;
        }

        .sort-select-wrapper {
            position: relative;
        }

        .sort-select {
            appearance: none;
            padding: 0.5rem 2.5rem 0.5rem 1rem;
            border: 1px solid #cbd5e1;
            border-radius: 0.5rem;
            background: white url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e") no-repeat right 0.5rem center/1.5em 1.5em;
            cursor: pointer;
            font-family: inherit;
            color: #334155;
            font-weight: 500;
        }

        .sort-select:focus {
            outline: none;
            border-color: #6366f1;
            ring: 2px solid #6366f1;
        }

        /* Artworks Grid */
        .artworks-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .artwork-card {
            background: white;
            border-radius: 1.25rem;
            overflow: hidden;
            border: 1px solid #f1f5f9;
            transition: all 0.3s ease;
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .artwork-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .artwork-image-container {
            position: relative;
            padding-top: 66.67%; /* 3:2 Aspect Ratio */
            overflow: hidden;
        }

        .artwork-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .artwork-card:hover .artwork-image {
            transform: scale(1.05);
        }

        .artwork-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.6) 0%, transparent 50%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .artwork-card:hover .artwork-overlay {
            opacity: 1;
        }

        .artwork-content {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .artwork-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .artwork-author {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
            color: #64748b;
            font-size: 0.9rem;
        }

        .avatar-placeholder {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #cbd5e1;
        }

        .artwork-footer {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid #f1f5f9;
        }

        .price-tag {
            font-size: 1.25rem;
            font-weight: 800;
            color: #4f46e5;
            display: flex;
            align-items: baseline;
            gap: 2px;
        }

        .rating-badge {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            background: #fffbeb;
            color: #b45309;
            padding: 0.25rem 0.5rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            font-weight: 600;
        }

        /* Empty State */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 6rem 2rem;
            background: white;
            border-radius: 1.5rem;
            border: 2px dashed #e2e8f0;
        }

        .empty-icon {
            font-size: 4rem;
            color: #cbd5e1;
            margin-bottom: 1rem;
            display: block;
        }
        
        .pagination-container {
            margin-top: 3rem;
            display: flex;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .filters-bar {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-bg-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
        </div>
        
        <div class="hero-content">
            <h1 class="hero-title">Discover Amazing Designs</h1>
            <p class="hero-subtitle">Browse thousands of creative works from talented designers around the world</p>
            
            <form method="GET" action="{{ route('home') }}" class="search-container">
                <input type="text" name="search" class="search-input" placeholder="What are you looking for?"
                    value="{{ request('search') }}">
                <button type="submit" class="search-btn">Search</button>
            </form>
        </div>
    </div>

    <!-- Categories -->
    <div class="categories-wrapper">
        <div class="categories-list">
            <a href="{{ route('home') }}" class="category-pill {{ !request('category') ? 'active' : '' }}">
                <span>All Assets</span>
            </a>
            @foreach($categories as $category)
                <a href="{{ route('home', ['category' => $category->id]) }}"
                    class="category-pill {{ request('category') == $category->id ? 'active' : '' }}">
                    <span>{{ $category->name }}</span>
                    <span style="opacity: 0.7; font-size: 0.85em; background: rgba(0,0,0,0.05); padding: 0 6px; border-radius: 10px;">
                        {{ $category->artworks_count }}
                    </span>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Filters & Results -->
    <div class="filters-bar">
        @if(request('search'))
            <div class="result-count">
                Found {{ $artworks->total() }} results for "<span style="color: #4f46e5; font-weight: 700;">{{ request('search') }}</span>"
            </div>
        @else
            <div class="result-count">
                Showing {{ $artworks->count() }} of {{ $artworks->total() }} artworks
            </div>
        @endif

        <form method="GET" action="{{ route('home') }}" class="sort-form">
            <input type="hidden" name="category" value="{{ request('category') }}">
            <input type="hidden" name="search" value="{{ request('search') }}">
            
            <div class="sort-select-wrapper">
                <select name="sort" class="sort-select" onchange="this.form.submit()">
                    <option value="">Latest Uploads</option>
                    <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                    <option value="reviews" {{ request('sort') == 'reviews' ? 'selected' : '' }}>Most Reviewed</option>
                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                </select>
            </div>
        </form>
    </div>

    <!-- Artworks Grid -->
    <div class="artworks-grid">
        @forelse($artworks as $artwork)
            <a href="{{ route('artworks.show', $artwork) }}" style="text-decoration:none; color:inherit;">
                <div class="artwork-card">
                    <div class="artwork-image-container">
                        <img src="{{ $artwork->image_url }}" alt="{{ $artwork->title }}" class="artwork-image">
                        <div class="artwork-overlay"></div>
                    </div>
                    
                    <div class="artwork-content">
                        <h3 class="artwork-title">{{ $artwork->title }}</h3>
                        
                        <div class="artwork-author">
                            <div class="avatar-placeholder">
                                <!-- Ideally use user avatar here -->
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($artwork->user->name) }}&background=random" 
                                     style="width:100%; height:100%; border-radius:50%;">
                            </div>
                            <span>{{ $artwork->user->name }}</span>
                        </div>

                        <div class="artwork-footer">
                            <div class="price-tag">
                                <span style="font-size: 0.8em; opacity: 0.7;">Rp</span>
                                {{ number_format($artwork->price, 0, ',', '.') }}
                            </div>
                            
                            @if($artwork->reviews_count > 0)
                                <div class="rating-badge">
                                    <span>★</span>
                                    <span>{{ number_format($artwork->average_rating, 1) }}</span>
                                    <span style="font-weight: 400; opacity: 0.7">({{ $artwork->reviews_count }})</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div class="empty-state">
                <span class="empty-icon">🎨</span>
                <h2>No designs found</h2>
                <p style="color: #64748b; margin-top: 0.5rem;">We couldn't find what you were looking for.</p>
                <a href="{{ route('home') }}" class="btn btn-outline" style="margin-top: 1.5rem; display: inline-block;">Clear Filters</a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="pagination-container">
        {{ $artworks->links() }}
    </div>
@endsection