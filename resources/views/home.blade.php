@extends('layouts.app')

<<<<<<< HEAD
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
=======
@section('title', 'PixelNest - Digital Artwork Marketplace')

@section('content')

<div class="min-h-screen bg-black text-white">

    <!-- NAVIGATION -->
    <nav class="max-w-7xl mx-auto px-6 py-6 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
                <span class="text-black font-bold text-xl">R</span>
            </div>
            <span class="text-xl font-bold tracking-tight">REGULATE</span>
        </div>
        
        <div class="hidden md:flex items-center gap-8 text-sm">
            <a href="#" class="text-white hover:text-zinc-300 transition-colors">Home</a>
            <a href="#" class="text-zinc-400 hover:text-white transition-colors">Benefits</a>
            <a href="#" class="text-zinc-400 hover:text-white transition-colors">About</a>
            <a href="#" class="text-zinc-400 hover:text-white transition-colors">Pricing</a>
            <a href="#" class="text-zinc-400 hover:text-white transition-colors">Blogs</a>
        </div>

        <button class="px-6 py-2.5 bg-white text-black rounded-full text-sm font-semibold hover:bg-zinc-200 transition-all duration-200">
            Contact Us
        </button>
    </nav>

    <!-- HERO SECTION -->
    <div class="max-w-7xl mx-auto px-6 pt-16 pb-24 text-center">
        <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold tracking-tight mb-6 leading-tight animate-fade-up">
            Regulate Your Focus<br>
            <span class="bg-gradient-to-r from-white via-zinc-300 to-zinc-500 bg-clip-text text-transparent">
                with Inspiring Content
            </span>
        </h1>
        
        <p class="text-zinc-400 text-lg md:text-xl max-w-2xl mx-auto mb-10 leading-relaxed animate-fade-up delay-200">
            Explore handpicked digital products in design, education, and creativity that align with your mood and personal ambitions.
        </p>

        <button class="group inline-flex items-center gap-3 px-8 py-4 bg-white text-black rounded-full font-semibold hover:bg-zinc-200 hover:scale-105 transition-all duration-300 shadow-xl shadow-white/10 animate-fade-up delay-400">
            <div class="w-6 h-6 bg-black rounded-full flex items-center justify-center">
                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                </svg>
            </div>
            Start Exploring Now
        </button>
    </div>

    <!-- CARDS SECTION -->
    <div class="max-w-7xl mx-auto px-6 pb-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- CARD 1 - Educational (Pink) -->
            <div class="group bg-gradient-to-br from-pink-400 to-pink-500 rounded-3xl p-8 hover:scale-105 transition-all duration-300 shadow-2xl hover:shadow-pink-500/50 cursor-pointer">
                <!-- Illustration Area -->
                <div class="h-48 mb-6 flex items-center justify-center relative">
                    <div class="absolute inset-0 bg-pink-300/20 rounded-2xl"></div>
                    <div class="relative z-10">
                        <!-- Trophy Icon -->
                        <svg class="w-32 h-32 text-pink-900" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <!-- Decorative elements -->
                    <div class="absolute top-4 right-4 flex gap-2">
                        <div class="w-3 h-3 bg-pink-900 rounded-full animate-pulse"></div>
                        <div class="w-3 h-3 bg-pink-900 rounded-full animate-pulse delay-100"></div>
                    </div>
                </div>

                <div class="inline-block px-4 py-1.5 bg-pink-900/30 rounded-full text-pink-900 text-xs font-bold mb-4">
                    Educational
                </div>

                <h3 class="text-2xl font-bold mb-3 text-pink-900">
                    Learn Skills That Shape Your Future
                </h3>
                
                <p class="text-pink-900/80 text-sm mb-6 leading-relaxed">
                    Dive into engaging lessons and unlock your true learning potential.
                </p>

                <button class="group/btn inline-flex items-center gap-2 px-6 py-3 bg-pink-900 text-white rounded-full font-semibold hover:bg-pink-800 transition-all duration-200">
                    <div class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                        </svg>
                    </div>
                    Watch Videos
                </button>
            </div>

            <!-- CARD 2 - Financial (Blue) -->
            <div class="group bg-gradient-to-br from-cyan-400 to-cyan-500 rounded-3xl p-8 hover:scale-105 transition-all duration-300 shadow-2xl hover:shadow-cyan-500/50 cursor-pointer">
                <!-- Illustration Area -->
                <div class="h-48 mb-6 flex items-center justify-center relative">
                    <div class="absolute inset-0 bg-cyan-300/20 rounded-2xl"></div>
                    <div class="relative z-10">
                        <!-- Money Icon -->
                        <svg class="w-32 h-32 text-cyan-900" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1 1.05.82 1.87 2.65 1.87 1.96 0 2.4-.98 2.4-1.59 0-.83-.44-1.61-2.67-2.14-2.48-.6-4.18-1.62-4.18-3.67 0-1.72 1.39-2.84 3.11-3.21V4h2.67v1.95c1.86.45 2.79 1.86 2.85 3.39H14.3c-.05-1.11-.64-1.87-2.22-1.87-1.5 0-2.4.68-2.4 1.64 0 .84.65 1.39 2.67 1.91s4.18 1.39 4.18 3.91c-.01 1.83-1.38 2.83-3.12 3.16z"/>
                        </svg>
                    </div>
                    <!-- Decorative elements -->
                    <div class="absolute top-4 left-4 flex gap-2">
                        <div class="w-4 h-4 border-2 border-cyan-900 rounded-full"></div>
                        <div class="w-4 h-4 border-2 border-cyan-900 rounded-full"></div>
                    </div>
                </div>

                <div class="inline-block px-4 py-1.5 bg-cyan-900/30 rounded-full text-cyan-900 text-xs font-bold mb-4">
                    Financial
                </div>

                <h3 class="text-2xl font-bold mb-3 text-cyan-900">
                    Master Your Finances with Expert Insights
                </h3>
                
                <p class="text-cyan-900/80 text-sm mb-6 leading-relaxed">
                    Discover strategies to grow wealth and manage money like a pro.
                </p>

                <button class="group/btn inline-flex items-center gap-2 px-6 py-3 bg-cyan-900 text-white rounded-full font-semibold hover:bg-cyan-800 transition-all duration-200">
                    <div class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                        </svg>
                    </div>
                    Watch Videos
                </button>
            </div>

            <!-- CARD 3 - Traveling (Orange) -->
            <div class="group bg-gradient-to-br from-orange-400 to-orange-500 rounded-3xl p-8 hover:scale-105 transition-all duration-300 shadow-2xl hover:shadow-orange-500/50 cursor-pointer">
                <!-- Illustration Area -->
                <div class="h-48 mb-6 flex items-center justify-center relative">
                    <div class="absolute inset-0 bg-orange-300/20 rounded-2xl"></div>
                    <div class="relative z-10">
                        <!-- Backpack Icon -->
                        <svg class="w-32 h-32 text-orange-900" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 8h-3V6c0-1.1-.9-2-2-2H9c-1.1 0-2 .9-2 2v2H4c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6h6v2H9V6zm11 14H4v-3h16v3zm0-5H4v-5h3v1.5c0 .83.67 1.5 1.5 1.5h7c.83 0 1.5-.67 1.5-1.5V10h3v5z"/>
                        </svg>
                    </div>
                    <!-- Decorative elements -->
                    <div class="absolute bottom-4 right-4 flex gap-2">
                        <div class="w-3 h-3 bg-orange-900 rounded-full"></div>
                        <div class="w-3 h-3 bg-orange-900 rounded-full"></div>
                    </div>
                </div>

                <div class="inline-block px-4 py-1.5 bg-orange-900/30 rounded-full text-orange-900 text-xs font-bold mb-4">
                    Traveling
                </div>

                <h3 class="text-2xl font-bold mb-3 text-orange-900">
                    Explore the World Through Inspiring Journeys
                </h3>
                
                <p class="text-orange-900/80 text-sm mb-6 leading-relaxed">
                    Find travel stories and guides to fuel your wanderlust and adventures.
                </p>

                <button class="group/btn inline-flex items-center gap-2 px-6 py-3 bg-orange-900 text-white rounded-full font-semibold hover:bg-orange-800 transition-all duration-200">
                    <div class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                        </svg>
                    </div>
                    Watch Videos
                </button>
            </div>

        </div>

        <!-- PRODUCTS SECTION -->
        <div class="mt-20">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <h2 class="text-4xl font-bold mb-2">Featured Products</h2>
                    <p class="text-zinc-400">Premium digital assets for your creative journey</p>
                </div>
                <a href="#" class="hidden md:inline-flex items-center gap-2 text-sm text-zinc-400 hover:text-white transition-colors">
                    View All
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Product Card 1 -->
                <div class="group bg-zinc-900 rounded-3xl p-8 border border-zinc-800 hover:border-zinc-700 hover:-translate-y-2 transition-all duration-300 shadow-xl">
                    <div class="h-48 rounded-2xl bg-gradient-to-br from-zinc-700 via-zinc-800 to-black mb-6 group-hover:from-zinc-600 group-hover:via-zinc-700 transition-all duration-300 flex items-center justify-center">
                        <svg class="w-20 h-20 text-zinc-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
                        </svg>
                    </div>
                    <div class="inline-block px-3 py-1 bg-pink-500/20 text-pink-400 text-xs font-bold rounded-full mb-4">
                        Educational
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-white">UI Design Kit</h3>
                    <p class="text-zinc-400 text-sm mb-6 leading-relaxed">
                        Modern UI kit for dashboard & mobile apps with 100+ components.
                    </p>
                    <div class="flex justify-between items-center pt-4 border-t border-zinc-800">
                        <span class="text-xl font-bold text-white">Rp 120.000</span>
                        <button class="px-6 py-2.5 rounded-full bg-white text-black text-sm font-bold hover:bg-zinc-200 hover:scale-105 transition-all duration-200">
                            Buy Now
                        </button>
                    </div>
                </div>

                <!-- Product Card 2 -->
                <div class="group bg-zinc-900 rounded-3xl p-8 border border-zinc-800 hover:border-zinc-700 hover:-translate-y-2 transition-all duration-300 shadow-xl">
                    <div class="h-48 rounded-2xl bg-gradient-to-br from-zinc-700 via-zinc-800 to-black mb-6 group-hover:from-zinc-600 group-hover:via-zinc-700 transition-all duration-300 flex items-center justify-center">
                        <svg class="w-20 h-20 text-zinc-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <div class="inline-block px-3 py-1 bg-cyan-500/20 text-cyan-400 text-xs font-bold rounded-full mb-4">
                        Financial
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-white">Brand Identity</h3>
                    <p class="text-zinc-400 text-sm mb-6 leading-relaxed">
                        Complete logo, color system & typography package for brands.
                    </p>
                    <div class="flex justify-between items-center pt-4 border-t border-zinc-800">
                        <span class="text-xl font-bold text-white">Rp 200.000</span>
                        <button class="px-6 py-2.5 rounded-full bg-white text-black text-sm font-bold hover:bg-zinc-200 hover:scale-105 transition-all duration-200">
                            Buy Now
                        </button>
                    </div>
                </div>

                <!-- Product Card 3 -->
                <div class="group bg-zinc-900 rounded-3xl p-8 border border-zinc-800 hover:border-zinc-700 hover:-translate-y-2 transition-all duration-300 shadow-xl">
                    <div class="h-48 rounded-2xl bg-gradient-to-br from-zinc-700 via-zinc-800 to-black mb-6 group-hover:from-zinc-600 group-hover:via-zinc-700 transition-all duration-300 flex items-center justify-center">
                        <svg class="w-20 h-20 text-zinc-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L4.5 20.29l.71.71L12 18l6.79 3 .71-.71L12 2z"/>
                        </svg>
                    </div>
                    <div class="inline-block px-3 py-1 bg-orange-500/20 text-orange-400 text-xs font-bold rounded-full mb-4">
                        Traveling
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-white">Web Landing Page</h3>
                    <p class="text-zinc-400 text-sm mb-6 leading-relaxed">
                        Clean & modern landing page design perfect for startups.
                    </p>
                    <div class="flex justify-between items-center pt-4 border-t border-zinc-800">
                        <span class="text-xl font-bold text-white">Rp 150.000</span>
                        <button class="px-6 py-2.5 rounded-full bg-white text-black text-sm font-bold hover:bg-zinc-200 hover:scale-105 transition-all duration-200">
                            Buy Now
                        </button>
>>>>>>> 6c9d1f181de761f38531d11c96559cf0ad585280
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
<<<<<<< HEAD
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="pagination-container">
        {{ $artworks->links() }}
    </div>
=======
        </div>

        <!-- PRICING SECTION -->
        <div class="mt-32" id="pricing">
            <!-- Header -->
            <div class="text-center mb-16">
                <p class="text-zinc-500 text-sm font-semibold mb-3 uppercase tracking-wider">Pricing</p>
                <h2 class="text-4xl md:text-5xl font-bold mb-4">
                    Choose the Perfect<br>
                    Plan for Your Business
                </h2>
                <p class="text-zinc-400 max-w-2xl mx-auto">
                    Whether you're just starting or scaling up, PixelNest has a plan that fits your needs.
                </p>
            </div>

            <!-- Pricing Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
                
                <!-- Free Plan -->
                <div class="group bg-gradient-to-br from-zinc-900 via-zinc-800 to-zinc-900 rounded-2xl p-8 border border-zinc-800 hover:border-zinc-700 transition-all duration-300">
                    <!-- Plan Header -->
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-white mb-2">Free</h3>
                        <div class="flex items-baseline gap-1 mb-3">
                            <span class="text-5xl font-bold text-white">$0</span>
                            <span class="text-zinc-500 text-sm">/ forever</span>
                        </div>
                        <p class="text-zinc-400 text-sm">Basic tools for small teams or individuals.</p>
                    </div>

                    <!-- CTA Button -->
                    <button class="w-full px-6 py-3 bg-zinc-800 text-white rounded-xl font-semibold hover:bg-zinc-700 transition-all duration-200 mb-6 border border-zinc-700">
                        Sign Up Now
                    </button>
                    <p class="text-zinc-600 text-xs text-center mb-6">Billed monthly.</p>

                    <!-- Features -->
                    <div class="space-y-3">
                        <p class="text-white font-semibold text-sm mb-4">Free Plan Includes</p>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-zinc-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-zinc-400 text-sm">Collaborate with up to 3 teammates</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-zinc-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-zinc-400 text-sm">Core task management features</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-zinc-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-zinc-400 text-sm">Unlimited projects and tasks</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-zinc-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-zinc-400 text-sm">Board and list views</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-zinc-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-zinc-400 text-sm">Basic integrations with top apps</span>
                        </div>
                    </div>
                </div>

                <!-- Pro Plan (Featured) -->
                <div class="group bg-gradient-to-br from-white via-zinc-100 to-white rounded-2xl p-8 border-2 border-white hover:shadow-2xl hover:shadow-white/10 transition-all duration-300 relative">
                    <!-- Popular Badge -->
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2">
                        <span class="px-4 py-1 bg-black text-white text-xs font-bold rounded-full">MOST POPULAR</span>
                    </div>

                    <!-- Plan Header -->
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-black mb-2">Pro</h3>
                        <div class="flex items-baseline gap-1 mb-3">
                            <span class="text-5xl font-bold text-black">$19</span>
                            <span class="text-zinc-600 text-sm">/ per month</span>
                        </div>
                        <p class="text-zinc-700 text-sm">Advanced tools for growing teams.</p>
                    </div>

                    <!-- CTA Button -->
                    <button class="w-full px-6 py-3 bg-black text-white rounded-xl font-semibold hover:bg-zinc-800 transition-all duration-200 mb-6 hover:scale-105">
                        Start Free Trial
                    </button>
                    <p class="text-zinc-500 text-xs text-center mb-6">Billed monthly.</p>

                    <!-- Features -->
                    <div class="space-y-3">
                        <p class="text-black font-semibold text-sm mb-4">All Free plan features, plus</p>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-black flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-zinc-700 text-sm">Collaborate with up to 10 teammates</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-black flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-zinc-700 text-sm">Custom workflows and templates</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-black flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-zinc-700 text-sm">Advanced tracking & reports</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-black flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-zinc-700 text-sm">Priority integrations</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-black flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-zinc-700 text-sm">Email support</span>
                        </div>
                    </div>
                </div>

                <!-- Team Plan -->
                <div class="group bg-gradient-to-br from-zinc-900 via-zinc-800 to-zinc-900 rounded-2xl p-8 border border-zinc-800 hover:border-zinc-700 transition-all duration-300">
                    <!-- Plan Header -->
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-white mb-2">Team</h3>
                        <div class="flex items-baseline gap-1 mb-3">
                            <span class="text-5xl font-bold text-white">$49</span>
                            <span class="text-zinc-500 text-sm">/ per month</span>
                        </div>
                        <p class="text-zinc-400 text-sm">Complete collaboration for larger teams.</p>
                    </div>

                    <!-- CTA Button -->
                    <button class="w-full px-6 py-3 bg-zinc-800 text-white rounded-xl font-semibold hover:bg-zinc-700 transition-all duration-200 mb-6 border border-zinc-700">
                        Start Free Trial
                    </button>
                    <p class="text-zinc-600 text-xs text-center mb-6">Billed monthly.</p>

                    <!-- Features -->
                    <div class="space-y-3">
                        <p class="text-white font-semibold text-sm mb-4">All Pro plan features, plus</p>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-zinc-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-zinc-400 text-sm">Up to 25 teammates</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-zinc-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-zinc-400 text-sm">Unlimited workflows & automations</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-zinc-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-zinc-400 text-sm">Real-time analytics</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-zinc-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-zinc-400 text-sm">Premium integrations</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-zinc-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-zinc-400 text-sm">Priority support</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="border-t border-zinc-900 mt-20">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
                        <span class="text-black font-bold text-xl">R</span>
                    </div>
                    <span class="text-xl font-bold tracking-tight">REGULATE</span>
                </div>
                <p class="text-zinc-500 text-sm">© 2026 Regulate. All rights reserved.</p>
            </div>
        </div>
    </footer>

</div>

>>>>>>> 6c9d1f181de761f38531d11c96559cf0ad585280
@endsection