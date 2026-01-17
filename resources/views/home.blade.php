@extends('layouts.app')

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

                <a href="#" class="text-zinc-400 hover:text-white transition-colors">Blogs</a>
            </div>

            <button
                class="px-6 py-2.5 bg-white text-black rounded-full text-sm font-semibold hover:bg-zinc-200 transition-all duration-200">
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
                Explore handpicked digital products in design, education, and creativity that align with your mood and
                personal ambitions.
            </p>

            <button
                class="group inline-flex items-center gap-3 px-8 py-4 bg-white text-black rounded-full font-semibold hover:bg-zinc-200 hover:scale-105 transition-all duration-300 shadow-xl shadow-white/10 animate-fade-up delay-400">
                <div class="w-6 h-6 bg-black rounded-full flex items-center justify-center">
                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z" />
                    </svg>
                </div>
                Start Exploring Now
            </button>
        </div>

        <!-- CARDS SECTION -->
        <div class="max-w-7xl mx-auto px-6 pb-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- CARD 1 - Educational (Pink) -->
                <div
                    class="group bg-gradient-to-br from-pink-400 to-pink-500 rounded-3xl p-8 hover:scale-105 transition-all duration-300 shadow-2xl hover:shadow-pink-500/50 cursor-pointer">
                    <!-- Illustration Area -->
                    <div class="h-48 mb-6 flex items-center justify-center relative">
                        <div class="absolute inset-0 bg-pink-300/20 rounded-2xl"></div>
                        <div class="relative z-10">
                            <!-- Trophy Icon -->
                            <svg class="w-32 h-32 text-pink-900" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
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

                    <button
                        class="group/btn inline-flex items-center gap-2 px-6 py-3 bg-pink-900 text-white rounded-full font-semibold hover:bg-pink-800 transition-all duration-200">
                        <div class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z" />
                            </svg>
                        </div>
                        Watch Videos
                    </button>
                </div>

                <!-- CARD 2 - Financial (Blue) -->
                <div
                    class="group bg-gradient-to-br from-cyan-400 to-cyan-500 rounded-3xl p-8 hover:scale-105 transition-all duration-300 shadow-2xl hover:shadow-cyan-500/50 cursor-pointer">
                    <!-- Illustration Area -->
                    <div class="h-48 mb-6 flex items-center justify-center relative">
                        <div class="absolute inset-0 bg-cyan-300/20 rounded-2xl"></div>
                        <div class="relative z-10">
                            <!-- Money Icon -->
                            <svg class="w-32 h-32 text-cyan-900" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1 1.05.82 1.87 2.65 1.87 1.96 0 2.4-.98 2.4-1.59 0-.83-.44-1.61-2.67-2.14-2.48-.6-4.18-1.62-4.18-3.67 0-1.72 1.39-2.84 3.11-3.21V4h2.67v1.95c1.86.45 2.79 1.86 2.85 3.39H14.3c-.05-1.11-.64-1.87-2.22-1.87-1.5 0-2.4.68-2.4 1.64 0 .84.65 1.39 2.67 1.91s4.18 1.39 4.18 3.91c-.01 1.83-1.38 2.83-3.12 3.16z" />
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

                    <button
                        class="group/btn inline-flex items-center gap-2 px-6 py-3 bg-cyan-900 text-white rounded-full font-semibold hover:bg-cyan-800 transition-all duration-200">
                        <div class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z" />
                            </svg>
                        </div>
                        Watch Videos
                    </button>
                </div>

                <!-- CARD 3 - Traveling (Orange) -->
                <div
                    class="group bg-gradient-to-br from-orange-400 to-orange-500 rounded-3xl p-8 hover:scale-105 transition-all duration-300 shadow-2xl hover:shadow-orange-500/50 cursor-pointer">
                    <!-- Illustration Area -->
                    <div class="h-48 mb-6 flex items-center justify-center relative">
                        <div class="absolute inset-0 bg-orange-300/20 rounded-2xl"></div>
                        <div class="relative z-10">
                            <!-- Backpack Icon -->
                            <svg class="w-32 h-32 text-orange-900" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20 8h-3V6c0-1.1-.9-2-2-2H9c-1.1 0-2 .9-2 2v2H4c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6h6v2H9V6zm11 14H4v-3h16v3zm0-5H4v-5h3v1.5c0 .83.67 1.5 1.5 1.5h7c.83 0 1.5-.67 1.5-1.5V10h3v5z" />
                            </svg>
                        </div>
                        <!-- Decorative elements -->
                        <div class="absolute bottom-4 right-4 flex gap-2">
                            <div class="w-3 h-3 bg-orange-900 rounded-full"></div>
                            <div class="w-3 h-3 bg-orange-900 rounded-full"></div>
                        </div>
                    </div>

                    <div
                        class="inline-block px-4 py-1.5 bg-orange-900/30 rounded-full text-orange-900 text-xs font-bold mb-4">
                        Traveling
                    </div>

                    <h3 class="text-2xl font-bold mb-3 text-orange-900">
                        Explore the World Through Inspiring Journeys
                    </h3>

                    <p class="text-orange-900/80 text-sm mb-6 leading-relaxed">
                        Find travel stories and guides to fuel your wanderlust and adventures.
                    </p>

                    <button
                        class="group/btn inline-flex items-center gap-2 px-6 py-3 bg-orange-900 text-white rounded-full font-semibold hover:bg-orange-800 transition-all duration-200">
                        <div class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z" />
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
                    <a href="#"
                        class="hidden md:inline-flex items-center gap-2 text-sm text-zinc-400 hover:text-white transition-colors">
                        View All
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Product Card 1 -->
                    <div
                        class="group bg-zinc-900 rounded-3xl p-8 border border-zinc-800 hover:border-zinc-700 hover:-translate-y-2 transition-all duration-300 shadow-xl">
                        <div
                            class="h-48 rounded-2xl bg-gradient-to-br from-zinc-700 via-zinc-800 to-black mb-6 group-hover:from-zinc-600 group-hover:via-zinc-700 transition-all duration-300 flex items-center justify-center">
                            <svg class="w-20 h-20 text-zinc-600" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" />
                            </svg>
                        </div>
                        <div
                            class="inline-block px-3 py-1 bg-pink-500/20 text-pink-400 text-xs font-bold rounded-full mb-4">
                            Educational
                        </div>
                        <h3 class="text-2xl font-bold mb-3 text-white">UI Design Kit</h3>
                        <p class="text-zinc-400 text-sm mb-6 leading-relaxed">
                            Modern UI kit for dashboard & mobile apps with 100+ components.
                        </p>
                        <div class="flex justify-between items-center pt-4 border-t border-zinc-800">
                            <span class="text-xl font-bold text-white">Rp 120.000</span>
                            <button
                                class="px-6 py-2.5 rounded-full bg-white text-black text-sm font-bold hover:bg-zinc-200 hover:scale-105 transition-all duration-200">
                                Buy Now
                            </button>
                        </div>
                    </div>

                    <!-- Product Card 2 -->
                    <div
                        class="group bg-zinc-900 rounded-3xl p-8 border border-zinc-800 hover:border-zinc-700 hover:-translate-y-2 transition-all duration-300 shadow-xl">
                        <div
                            class="h-48 rounded-2xl bg-gradient-to-br from-zinc-700 via-zinc-800 to-black mb-6 group-hover:from-zinc-600 group-hover:via-zinc-700 transition-all duration-300 flex items-center justify-center">
                            <svg class="w-20 h-20 text-zinc-600" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                            </svg>
                        </div>
                        <div
                            class="inline-block px-3 py-1 bg-cyan-500/20 text-cyan-400 text-xs font-bold rounded-full mb-4">
                            Financial
                        </div>
                        <h3 class="text-2xl font-bold mb-3 text-white">Brand Identity</h3>
                        <p class="text-zinc-400 text-sm mb-6 leading-relaxed">
                            Complete logo, color system & typography package for brands.
                        </p>
                        <div class="flex justify-between items-center pt-4 border-t border-zinc-800">
                            <span class="text-xl font-bold text-white">Rp 200.000</span>
                            <button
                                class="px-6 py-2.5 rounded-full bg-white text-black text-sm font-bold hover:bg-zinc-200 hover:scale-105 transition-all duration-200">
                                Buy Now
                            </button>
                        </div>
                    </div>

                    <!-- Product Card 3 -->
                    <div
                        class="group bg-zinc-900 rounded-3xl p-8 border border-zinc-800 hover:border-zinc-700 hover:-translate-y-2 transition-all duration-300 shadow-xl">
                        <div
                            class="h-48 rounded-2xl bg-gradient-to-br from-zinc-700 via-zinc-800 to-black mb-6 group-hover:from-zinc-600 group-hover:via-zinc-700 transition-all duration-300 flex items-center justify-center">
                            <svg class="w-20 h-20 text-zinc-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L4.5 20.29l.71.71L12 18l6.79 3 .71-.71L12 2z" />
                            </svg>
                        </div>
                        <div
                            class="inline-block px-3 py-1 bg-orange-500/20 text-orange-400 text-xs font-bold rounded-full mb-4">
                            Traveling
                        </div>
                        <h3 class="text-2xl font-bold mb-3 text-white">Web Landing Page</h3>
                        <p class="text-zinc-400 text-sm mb-6 leading-relaxed">
                            Clean & modern landing page design perfect for startups.
                        </p>
                        <div class="flex justify-between items-center pt-4 border-t border-zinc-800">
                            <span class="text-xl font-bold text-white">Rp 150.000</span>
                            <button
                                class="px-6 py-2.5 rounded-full bg-white text-black text-sm font-bold hover:bg-zinc-200 hover:scale-105 transition-all duration-200">
                                Buy Now
                            </button>
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

@endsection