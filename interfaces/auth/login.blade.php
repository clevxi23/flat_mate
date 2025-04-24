@extends('website.layouts.app')

@section('title', 'Login')


@section('content')

    <div class="hero page-inner overlay d-flex align-items-center" style="background-image: url('{{ asset('assets/images/hero_bg_1.jpg') }}'); min-height: 400px;">
        <div class="container text-center text-white">
            <h1 class="display-4 text-white fw-bold">Welcome Back</h1>
        </div>
    </div>

    <div class="login-container">
        <div class="login-box">
            <h3>Login to FlatMate</h3>

            <form action="{{ route('website.login_submit') }}" method="POST">
                @csrf
                <!-- Select Role -->
                <div class="form-group">
                    <label for="role">Login As</label>
                    <select name="role" class="form-control">
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : ''}}>Admin</option>
                        <option value="roommate" {{ old('role') == 'roommate' ? 'selected' : ''}}>Roommate</option>
                        <option value="house_owner" {{ old('role') == 'house_owner' ? 'selected' : ''}}>House Owner</option>
                    </select>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{old('email')}}" placeholder="Enter your email" required>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>

                <button type="submit" class="btn btn-primary btn-login">Login</button>

                <div class="text-center mt-3">
                    <a href="{{ route('website.nafath.simulate') }}" class="btn btn-outline-primary w-100 mt-3">
                        <img src="https://nafith.sa/assets/nafith_logo-24b9d2e1.png" style="height: 24px;" class="me-2">
                        Login with Nafath
                    </a>

                    <br>
                    <br>
                    <br>
                    <a href="{{ route('website.register') }}">Don't have an account? Register</a>
                    <br>
                    <br>
                    <a href="{{ route('website.forgot_password') }}">Forgot Password?</a>
                </div>
            </form>
        </div>
    </div>
@endsection
