<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PixelNest - Digital Artwork Marketplace')</title>

    {{-- Alpine.js for dropdown functionality --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Fade Up Animation */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Fade In Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Animation Classes */
        .animate-fade-up {
            animation: fadeUp 0.8s ease-out forwards;
            opacity: 0;
        }

        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
            opacity: 0;
        }

        /* Delay Classes */
        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }

        .delay-400 {
            animation-delay: 0.4s;
        }

        .delay-500 {
            animation-delay: 0.5s;
        }

        .delay-600 {
            animation-delay: 0.6s;
        }

        .delay-700 {
            animation-delay: 0.7s;
        }

        .delay-800 {
            animation-delay: 0.8s;
        }
    </style>
</head>

<body class="bg-black text-white antialiased">

    {{-- HEADER --}}
    @hasSection('no-header')
        {{-- header dimatikan --}}
    @else
        <nav class="border-b border-zinc-900 bg-black/50 backdrop-blur-lg sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    {{-- Logo (Left) --}}
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                            <div
                                class="w-8 h-8 bg-white rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                <span class="text-black font-bold text-xl">P</span>
                            </div>
                            <span
                                class="text-xl font-bold tracking-tight hidden sm:inline group-hover:text-zinc-300 transition-colors duration-200">PIXELNEST</span>
                        </a>
                    </div>

                    {{-- Nav Links (Center) --}}
                    <div class="hidden md:flex items-center gap-6">
                        <a href="{{ route('home') }}"
                            class="relative text-sm font-medium text-zinc-400 hover:text-white transition-colors duration-200 group">
                            Home
                            <span
                                class="absolute -bottom-1 left-0 w-0 h-0.5 bg-white group-hover:w-full transition-all duration-300"></span>
                        </a>
                        @auth
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}"
                                    class="relative text-sm font-medium text-zinc-400 hover:text-white transition-colors duration-200 group">
                                    Dashboard
                                    <span
                                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-white group-hover:w-full transition-all duration-300"></span>
                                </a>
                                <a href="{{ route('admin.artworks.index') }}"
                                    class="relative text-sm font-medium text-zinc-400 hover:text-white transition-colors duration-200 group">
                                    Artworks
                                    <span
                                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-white group-hover:w-full transition-all duration-300"></span>
                                </a>
                                <a href="{{ route('admin.categories.index') }}"
                                    class="relative text-sm font-medium text-zinc-400 hover:text-white transition-colors duration-200 group">
                                    Categories
                                    <span
                                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-white group-hover:w-full transition-all duration-300"></span>
                                </a>
                            @else
                                {{-- Regular User Menu --}}
                                <a href="{{ route('categories.index') }}"
                                    class="relative text-sm font-medium text-zinc-400 hover:text-white transition-colors duration-200 group">
                                    Categories
                                    <span
                                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-white group-hover:w-full transition-all duration-300"></span>
                                </a>
                                <a href="{{ route('about') }}"
                                    class="relative text-sm font-medium text-zinc-400 hover:text-white transition-colors duration-200 group">
                                    About
                                    <span
                                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-white group-hover:w-full transition-all duration-300"></span>
                                </a>
                            @endif
                        @else
                            {{-- Guest Menu --}}
                            <a href="{{ route('categories.index') }}"
                                class="relative text-sm font-medium text-zinc-400 hover:text-white transition-colors duration-200 group">
                                Categories
                                <span
                                    class="absolute -bottom-1 left-0 w-0 h-0.5 bg-white group-hover:w-full transition-all duration-300"></span>
                            </a>
                            <a href="{{ route('about') }}"
                                class="relative text-sm font-medium text-zinc-400 hover:text-white transition-colors duration-200 group">
                                About
                                <span
                                    class="absolute -bottom-1 left-0 w-0 h-0.5 bg-white group-hover:w-full transition-all duration-300"></span>
                            </a>
                        @endauth

                        {{-- Search Bar --}}
                        <div class="relative">
                            <form action="{{ route('artworks.search') }}" method="GET" class="relative">
                                <input type="text" name="q" placeholder="Search artworks..."
                                    class="w-64 px-4 py-2 pl-10 bg-zinc-900 border border-zinc-800 rounded-full text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-white/20 focus:border-zinc-600 transition-all duration-200">
                                <svg class="w-4 h-4 text-zinc-500 absolute left-3 top-1/2 -translate-y-1/2" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </form>
                        </div>
                    </div>

                    {{-- Right Side Actions --}}
                    <div class="flex items-center gap-3">
                        @auth
                            {{-- Profile Dropdown --}}
                            <div class="relative" x-data="{ open: false }" @click.away="open = false">
                                {{-- Profile Button --}}
                                <button @click="open = !open"
                                    class="flex items-center gap-3 px-4 py-2 bg-zinc-900 rounded-full border border-zinc-800 hover:border-zinc-700 hover:bg-zinc-800 transition-all duration-200">
                                    {{-- Avatar --}}
                                    <div
                                        class="w-8 h-8 bg-gradient-to-br from-zinc-600 to-zinc-800 rounded-full flex items-center justify-center text-white text-sm font-bold ring-2 ring-zinc-700">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                    {{-- Name (hidden on mobile) --}}
                                    <span
                                        class="text-sm font-medium text-white hidden md:inline">{{ auth()->user()->name }}</span>
                                    {{-- Dropdown Arrow --}}
                                    <svg class="w-4 h-4 text-zinc-400 transition-transform duration-200"
                                        :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                {{-- Dropdown Menu --}}
                                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                    class="absolute right-0 mt-2 w-64 bg-zinc-900 border border-zinc-800 rounded-xl shadow-2xl overflow-hidden z-50"
                                    style="display: none;">

                                    {{-- User Info Header --}}
                                    <div class="px-4 py-3 border-b border-zinc-800 bg-gradient-to-br from-zinc-900 to-zinc-800">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 bg-gradient-to-br from-zinc-600 to-zinc-800 rounded-full flex items-center justify-center text-white font-bold ring-2 ring-zinc-700">
                                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-semibold text-white truncate">{{ auth()->user()->name }}
                                                </p>
                                                <p class="text-xs text-zinc-400 truncate">{{ auth()->user()->email }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Menu Items --}}
                                    <div class="py-2">
                                        @if(!auth()->user()->isAdmin())
                                            {{-- My Artworks --}}
                                            <a href="{{ route('user.artworks.index') }}"
                                                class="flex items-center gap-3 px-4 py-3 text-zinc-300 hover:bg-zinc-800 hover:text-white transition-colors duration-200 group">
                                                <div
                                                    class="w-8 h-8 bg-zinc-800 rounded-lg flex items-center justify-center group-hover:bg-zinc-700 transition-colors duration-200">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                                <span class="text-sm font-medium">My Artworks</span>
                                            </a>

                                            {{-- Cart --}}
                                            <a href="{{ route('cart.index') }}"
                                                class="flex items-center gap-3 px-4 py-3 text-zinc-300 hover:bg-zinc-800 hover:text-white transition-colors duration-200 group">
                                                <div
                                                    class="w-8 h-8 bg-zinc-800 rounded-lg flex items-center justify-center group-hover:bg-zinc-700 transition-colors duration-200 relative">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                                    </svg>
                                                    @if(count(session()->get('cart', [])) > 0)
                                                        <span
                                                            class="absolute -top-1 -right-1 px-1 py-0.5 bg-white text-black text-[10px] font-bold rounded-full min-w-[16px] text-center">
                                                            {{ count(session()->get('cart', [])) }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <span class="text-sm font-medium">Cart</span>
                                                @if(count(session()->get('cart', [])) > 0)
                                                    <span
                                                        class="ml-auto text-xs font-bold text-white bg-zinc-700 px-2 py-1 rounded-full">
                                                        {{ count(session()->get('cart', [])) }}
                                                    </span>
                                                @endif
                                            </a>

                                            {{-- Orders (Purchase History) --}}
                                            <a href="{{ route('user.orders.index') }}"
                                                class="flex items-center gap-3 px-4 py-3 text-zinc-300 hover:bg-zinc-800 hover:text-white transition-colors duration-200 group">
                                                <div
                                                    class="w-8 h-8 bg-zinc-800 rounded-lg flex items-center justify-center group-hover:bg-zinc-700 transition-colors duration-200">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                                    </svg>
                                                </div>
                                                <span class="text-sm font-medium">Orders</span>
                                            </a>

                                            <div class="border-t border-zinc-800 my-2"></div>
                                        @endif

                                        {{-- Logout --}}
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit"
                                                class="w-full flex items-center gap-3 px-4 py-3 text-red-400 hover:bg-zinc-800 hover:text-red-300 transition-colors duration-200 group">
                                                <div
                                                    class="w-8 h-8 bg-zinc-800 rounded-lg flex items-center justify-center group-hover:bg-red-900/30 transition-colors duration-200">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                    </svg>
                                                </div>
                                                <span class="text-sm font-medium">Logout</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}"
                                class="px-4 py-2 bg-zinc-900 text-white rounded-xl text-sm font-semibold hover:bg-zinc-800 border border-zinc-800 hover:border-zinc-700 transition-colors duration-200">
                                Login
                            </a>
                            <a href="{{ route('register') }}"
                                class="px-4 py-2 bg-white text-black rounded-xl text-sm font-semibold hover:bg-zinc-100 transition-colors duration-200">
                                Register
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    @endif

    {{-- FLASH MESSAGE --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 animate-slide-up">
            <div class="bg-green-900/20 border border-green-500/50 text-green-300 px-6 py-4 rounded-lg backdrop-blur-lg">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 animate-slide-up">
            <div class="bg-red-900/20 border border-red-500/50 text-red-300 px-6 py-4 rounded-lg backdrop-blur-lg">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        </div>
    @endif

    {{-- MAIN CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @hasSection('no-footer')
        {{-- footer dimatikan --}}
    @else
        <footer class="border-t border-zinc-900 mt-20 bg-black">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
                            <span class="text-black font-bold text-xl">P</span>
                        </div>
                        <span class="text-xl font-bold tracking-tight">PIXELNEST</span>
                    </div>
                    <p class="text-zinc-500 text-sm">© 2025 PixelNest. All rights reserved.</p>
                    <div class="flex items-center gap-6 text-sm text-zinc-500">
                        <a href="#" class="hover:text-white transition-colors duration-200">Privacy Policy</a>
                        <a href="#" class="hover:text-white transition-colors duration-200">Terms of Service</a>
                        <a href="#" class="hover:text-white transition-colors duration-200">Contact</a>
                    </div>
                </div>
            </div>
        </footer>
    @endif

</body>

</html>