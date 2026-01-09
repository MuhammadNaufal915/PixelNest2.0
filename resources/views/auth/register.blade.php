@extends('layouts.app')

@section('title', 'Sign Up - PixelNest')

@section('styles')
<style>
    /* Reuse Login Styles for Consistency */
    body {
        background-color: #f8fafc;
    }

    .auth-wrapper {
        min-height: 90vh; /* Slightly taller for register form */
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #db2777 100%);
        border-radius: 1.5rem;
        position: relative;
        overflow: hidden;
        margin-top: 1rem;
    }

    .auth-bg-shapes {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
    }

    .shape {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        opacity: 0.5;
    }

    .shape-1 {
        width: 400px;
        height: 400px;
        background: #60a5fa;
        top: -100px;
        right: -100px;
    }

    .shape-2 {
        width: 300px;
        height: 300px;
        background: #f472b6;
        bottom: -50px;
        left: -50px;
    }

    .auth-card {
        background: white;
        width: 100%;
        max-width: 500px;
        padding: 2.5rem;
        border-radius: 1.5rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        position: relative;
        z-index: 10;
        border: 1px solid rgba(255,255,255,0.5);
    }

    .auth-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .auth-logo-icon {
        width: 48px;
        height: 48px;
        margin-bottom: 1rem;
        display: inline-block;
    }

    .auth-header h1 {
        font-size: 1.8rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }

    .auth-header p {
        color: #64748b;
        font-size: 1rem;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-label {
        display: block;
        font-size: 0.9rem;
        font-weight: 600;
        color: #334155;
        margin-bottom: 0.5rem;
    }

    .form-input {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 2px solid #e2e8f0;
        border-radius: 0.75rem;
        font-size: 1rem;
        color: #1e293b;
        transition: all 0.2s;
        background: #f8fafc;
    }

    .form-input:focus {
        outline: none;
        border-color: #6366f1;
        background: white;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .form-error {
        color: #ef4444;
        font-size: 0.85rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .btn-auth {
        width: 100%;
        padding: 0.875rem;
        background: linear-gradient(135deg, #4f46e5 0%, #db2777 100%);
        color: white;
        border: none;
        border-radius: 0.75rem;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
        margin-top: 1rem;
    }

    .btn-auth:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
    }

    .auth-footer {
        text-align: center;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid #f1f5f9;
        font-size: 0.95rem;
        color: #64748b;
    }

    .auth-link {
        color: #4f46e5;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s;
    }

    .auth-link:hover {
        color: #db2777;
    }
</style>
@endsection

@section('content')
<div class="auth-wrapper">
    <div class="auth-bg-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
    </div>

    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-logo-icon">
                <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="40" height="40" rx="12" fill="url(#reg_logo_gradient)"/>
                    <path d="M20 12C15.5817 12 12 15.5817 12 20C12 24.4183 15.5817 28 20 28C24.4183 28 28 24.4183 28 20C28 15.5817 24.4183 12 20 12ZM20 25C17.2386 25 15 22.7614 15 20C15 17.2386 17.2386 15 20 15C22.7614 15 25 17.2386 25 20C25 22.7614 22.7614 25 20 25Z" fill="white"/>
                    <circle cx="26" cy="14" r="4" fill="#F472B6"/>
                    <defs>
                        <linearGradient id="reg_logo_gradient" x1="0" y1="0" x2="40" y2="40" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#4F46E5"/>
                            <stop offset="1" stop-color="#EC4899"/>
                        </linearGradient>
                    </defs>
                </svg>
            </div>
            <h1>Create Account</h1>
            <p>Join our community of creative designers</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-input" value="{{ old('name') }}" required autofocus
                    placeholder="John Doe">
                @error('name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-input" value="{{ old('email') }}" required
                    placeholder="name@example.com">
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" required placeholder="Create a strong password">
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-input" required placeholder="Confirm your password">
            </div>

            <button type="submit" class="btn-auth">Create Account</button>
        </form>

        <div class="auth-footer">
            Already have an account? <a href="{{ route('login') }}" class="auth-link">Sign In</a>
        </div>
    </div>
</div>
@endsection
