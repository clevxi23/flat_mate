@extends('website.layouts.app')
@section('title', 'Register as House Owner')
@section('content')

    <div class="hero page-inner overlay d-flex align-items-center"
         style="background-image: url('{{ asset('assets/images/hero_bg_1.jpg') }}'); min-height: 300px;">
        <div class="container text-center text-white">
            <h1 class="display-4 text-white fw-bold">Register as House Owner</h1>
        </div>
    </div>

    <div class="registration-container section">
        <div class="registration-box">
            <form action="{{ route('website.register_submit') }}" method="POST">
                @csrf

                <!-- Full Name -->
                <div class="form-group">
                    <label class="form-label">Full Name <span>*</span></label>
                    <input type="text" name="acc_name" class="form-control" value="{{ old('acc_name') }}" required>
                    @error('acc_name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label class="form-label">Email <span>*</span></label>
                    <input type="email" name="acc_email" class="form-control" value="{{ old('acc_email') }}" required>
                    @error('acc_email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Phone Number -->
                <div class="form-group">
                    <label class="form-label">Phone Number <span>*</span></label>
                    <input type="text" name="acc_phone" class="form-control" value="{{ old('acc_phone') }}" required>
                    <small class="form-text text-muted">Hint: Must start with 05 or +9665 followed by 8 digits</small>
                    @error('acc_phone')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label class="form-label">Password <span>*</span></label>
                    <input type="password" name="acc_password" class="form-control" required>
                    <small class="form-text text-muted">Hint: Min 8 chars, must contain letters, digits, and symbols</small>
                    @error('acc_password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label class="form-label">Confirm Password <span>*</span></label>
                    <input type="password" name="acc_password_confirmation" class="form-control" required>
                </div>

                <!-- Gender -->
                <div class="form-group">
                    <label class="form-label">Gender</label>
                    <select name="acc_gender" class="form-control">
                        <option value="Male" {{ old('acc_gender') === 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('acc_gender') === 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('acc_gender')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Address -->
                <div class="form-group">
                    <label class="form-label">Address</label>
                    <input type="text" name="acc_address" class="form-control" value="{{ old('acc_address') }}">
                    @error('acc_address')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Hidden Account Type -->
                <input type="hidden" name="acc_type" value="house_owner">

                <!-- Hidden Default Values -->
                <input type="hidden" name="acc_point" value="0">
                <input type="hidden" name="acc_total_count" value="0">

                <button type="submit" class="btn btn-primary btn-register">Register</button>

                <div class="text-center mt-3">
                    <a href="{{ route('website.login') }}">Already have an account? Login</a>
                </div>
            </form>
        </div>
    </div>
@endsection
