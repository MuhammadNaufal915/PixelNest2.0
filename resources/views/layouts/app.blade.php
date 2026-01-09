<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PixelNest - Design Marketplace')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #ec4899;
            --dark: #0f172a;
            --dark-light: #1e293b;
            --gray: #64748b;
            --gray-light: #cbd5e1;
            --white: #ffffff;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-2: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: var(--dark);
            line-height: 1.6;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
        }

        /* Navigation */
        .navbar {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 1.5rem;
            z-index: 1000;
            margin: 0 auto 3rem auto;
            width: 95%;
            max-width: 1280px;
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.4);
            transition: all 0.3s ease;
        }
        
        /* Scroll effect can be added via JS later, for now we stick to initial state */

        .nav-container {
            width: 100%;
            padding: 0.75rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 800;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--dark-light);
            font-weight: 600;
            font-size: 0.95rem;
            transition: color 0.3s;
            position: relative;
        }

        .nav-links a:hover {
            color: var(--primary);
        }
        
        /* Interactive dot on hover */
        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 50%;
            width: 0;
            height: 4px;
            background: var(--primary);
            border-radius: 50%;
            transform: translateX(-50%);
            transition: width 0.3s;
        }
        
        .nav-links a:hover::after {
            width: 4px;
        }

        .btn {
            padding: 0.5rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            display: inline-block;
            font-size: 0.95rem;
        }

        .btn-primary {
            background: var(--gradient);
            color: var(--white);
            box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.5);
        }

        .btn-outline {
            border: 2px solid var(--primary);
            color: var(--primary);
            background: transparent;
        }
        
        /* Nav specific buttons */
        .btn-nav-ghost {
            background: transparent;
            color: var(--dark);
            padding: 0.5rem 1rem;
        }
        
        .btn-nav-ghost:hover {
            color: var(--primary);
        }

        .btn-nav-pill {
            background: var(--gradient);
            color: white;
            border-radius: 9999px;
            padding: 0.6rem 2rem;
            box-shadow: 0 4px 10px rgba(99, 102, 241, 0.3);
        }
        
        .btn-nav-pill:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 15px rgba(99, 102, 241, 0.4);
        }

        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Alert Messages */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            animation: slideIn 0.3s ease;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border-left: 4px solid var(--success);
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border-left: 4px solid var(--danger);
        }

        .alert-info {
            background: #dbeafe;
            color: #1e40af;
            border-left: 4px solid var(--primary);
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Footer */
        .footer {
            background: var(--dark);
            color: var(--white);
            padding: 3rem 2rem;
            margin-top: 5rem;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            text-align: center;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                gap: 1rem;
            }
            
            .container {
                padding: 1rem;
            }
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo">
                <svg width="32" height="32" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="40" height="40" rx="12" fill="url(#logo_gradient)"/>
                    <path d="M20 12C15.5817 12 12 15.5817 12 20C12 24.4183 15.5817 28 20 28C24.4183 28 28 24.4183 28 20C28 15.5817 24.4183 12 20 12ZM20 25C17.2386 25 15 22.7614 15 20C15 17.2386 17.2386 15 20 15C22.7614 15 25 17.2386 25 20C25 22.7614 22.7614 25 20 25Z" fill="white"/>
                    <circle cx="26" cy="14" r="4" fill="#F472B6"/>
                    <defs>
                        <linearGradient id="logo_gradient" x1="0" y1="0" x2="40" y2="40" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#4F46E5"/>
                            <stop offset="1" stop-color="#EC4899"/>
                        </linearGradient>
                    </defs>
                </svg>
                PixelNest
            </a>
            
            <ul class="nav-links">
                <li><a href="{{ route('home') }}">Explore</a></li>
                
                @auth
                    @if(auth()->user()->isAdmin())
                        <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                    @else
                        <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('cart.index') }}">Cart</a></li>
                    @endif
                    
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-outline">Logout</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}" class="btn btn-nav-ghost">Login</a></li>
                    <li><a href="{{ route('register') }}" class="btn btn-nav-pill">Sign Up</a></li>
                @endauth
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            @if(session('info'))
                <div class="alert alert-info">{{ session('info') }}</div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <p>&copy; {{ date('Y') }} PixelNest. Design Marketplace for Creative Minds.</p>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
