@extends('layouts.app')

@section('content')

<section class="auth-page login-page">

    <div class="auth-window">

        <div class="auth-content">

            <div class="auth-form-side">

                <a href="{{ route('home') }}" class="auth-logo">FurniHome</a>

                <div class="auth-form-box">

                    <h1>Login</h1>

                    @if($errors->any())
                        <div class="auth-error">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('login.store') }}" method="POST" class="auth-form">
                        @csrf

                        <div class="auth-field">
                            <label for="email">Email*</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Enter your email"
                                required
                            >
                        </div>

                        <div class="auth-field">
                            <label for="password">Password*</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Enter your password"
                                required
                            >
                        </div>

                        <div class="auth-options">
                            <label class="remember-me">
                                <input type="checkbox" name="remember">
                                <span>Remember me</span>
                            </label>

                            <a href="#">Forgot password?</a>
                        </div>

                        <button type="submit" class="auth-submit-btn">
                            Login
                        </button>
                    </form>

                    <div class="auth-switch">
                        Don’t have an account?
                        <a href="{{ route('register') }}" class="auth-transition-link">Create account</a>
                    </div>

                    <a href="{{ route('home') }}" class="auth-back-link">
                        ← Back to FurniHome
                    </a>

                </div>

            </div>

            <div class="auth-image-side">
                <img src="{{ asset('images/auth/login.jpg') }}" alt="FurniHome login">
            </div>

        </div>

    </div>

</section>

@endsection