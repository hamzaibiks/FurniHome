@extends('layouts.app')

@section('content')

<section class="auth-page register-page">

    <div class="auth-window">

        <div class="auth-content register-auth-content">

            <div class="auth-image-side register-image-side">
                <img src="{{ asset('images/auth/register.jpg') }}" alt="FurniHome register">
            </div>

            <div class="auth-form-side register-form-side">

                <a href="{{ route('home') }}" class="auth-logo register-logo">FurniHome</a>

                <div class="auth-form-box">

                    <h1>Create account</h1>

                    @if($errors->any())
                        <div class="auth-error">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('register.store') }}" method="POST" class="auth-form">
                        @csrf

                        <div class="auth-field">
                            <label for="name">Full Name*</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Enter your full name"
                                required
                            >
                        </div>

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
                            <label for="phone">Phone Number*</label>
                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                value="{{ old('phone') }}"
                                placeholder="Enter your phone number"
                                required
                            >
                        </div>

                        <div class="auth-field">
                            <label for="password">Password*</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Create a password"
                                required
                            >
                        </div>

                        <div class="auth-field">
                            <label for="password_confirmation">Confirm Password*</label>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="Confirm your password"
                                required
                            >
                        </div>

                        <button type="submit" class="auth-submit-btn">
                            Sign Up
                        </button>
                    </form>

                    <div class="auth-switch">
                        Already have an account?
                        <a href="{{ route('login') }}" class="auth-transition-link">Login</a>
                    </div>

                    <a href="{{ route('home') }}" class="auth-back-link">
                        ← Back to FurniHome
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection