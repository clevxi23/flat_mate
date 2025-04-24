@extends('website.layouts.app')

@section('title', 'Forgot Password')

@section('content')

    <!-- Hero Section -->
    <div class="hero page-inner overlay d-flex align-items-center" style="background-image: url('{{ asset('assets/images/hero_bg_1.jpg') }}'); min-height: 300px;">
        <div class="container text-center text-white">
            <h1 class="display-4 text-white fw-bold">Forgot Password?</h1>
            <p class="lead">Enter your email to reset your password and regain access to your account.</p>
        </div>
    </div>

    <!-- Forgot Password Form -->
    <div class="section forgot-password-container">
        <div class="forgot-password-box">
            <h3>Reset Your Password</h3>

            <form action="#" method="get">
                @csrf
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                </div>

                <!-- Reset Button -->
                <button type="submit" class="btn btn-primary btn-reset">Send Reset Link</button>

                <!-- Additional Links -->
                <div class="text-center mt-3">
                    <a href="{{ route('website.login') }}">Back to Login</a> |
                    <a href="{{ route('website.register') }}">Create an Account</a>
                </div>
            </form>
        </div>
    </div>

@endsection
