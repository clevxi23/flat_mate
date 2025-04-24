@extends('website.layouts.app')

@section('title', 'Roommate Profile')

@push('css')
    <style>
        .profile-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .form-label {
            font-weight: 600;
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <div class="hero page-inner overlay" style="background-image: url('{{ asset('assets/images/hero_bg_3.jpg') }}')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading text-white" data-aos="fade-up">Profile</h1>
                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Container -->
    <div class="container dashboard-content mt-5 mb-4">
        <div class="profile-container">
            <h3 class="mb-4">My Profile</h3>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Profile Preview -->
            <div id="profilePreview">
                <div class="profile-container text-center">
                    <h3 class="text-success"><i class="fas fa-coins"></i> points</h3>
                    <p>You have earned <strong class="text-warning">{{ $totalPoints }} points</strong> from <strong class="text-primary">{{ $reviews->count() }} reviews</strong>.</p>
                </div>
                <ul class="list-group mb-4">
                    <li class="list-group-item"><strong>Name:</strong> {{ $user->acc_name }}</li>
                    <li class="list-group-item"><strong>Email:</strong> {{ $user->acc_email }}</li>
                    <li class="list-group-item"><strong>Phone:</strong> {{ $user->acc_phone }}</li>
                    <li class="list-group-item"><strong>Gender:</strong> {{ $user->acc_gender }}</li>
                    <li class="list-group-item"><strong>Address:</strong> {{ $user->acc_address }}</li>
                    <li class="list-group-item"><strong>Age:</strong> {{ $user->acc_age ?? '—' }}</li>
                    <li class="list-group-item"><strong>Smoking:</strong>
                        {{ $user->acc_smoking === 1 ? 'Yes' : ($user->acc_smoking === 0 ? 'No' : '—') }}
                    </li>
                    <li class="list-group-item"><strong>Employment Status:</strong> {{ $user->acc_status ?? '—' }}</li>
                </ul>

                <button onclick="document.getElementById('profilePreview').style.display='none'; document.getElementById('profileEditForm').style.display='block';"
                        class="btn btn-outline-primary w-100">Edit Profile <i class="fa fa-pen"></i></button>
            </div>

            <!-- Profile Edit Form -->
            <div id="profileEditForm" style="display: none;">
                <form action="{{ route('roommate.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('acc_name') is-invalid @enderror" name="acc_name" value="{{ old('acc_name', $user->acc_name) }}" required>
                        @error('acc_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('acc_email') is-invalid @enderror" name="acc_email" value="{{ old('acc_email', $user->acc_email) }}" required>
                        @error('acc_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('acc_phone') is-invalid @enderror" name="acc_phone" value="{{ old('acc_phone', $user->acc_phone) }}" placeholder="+966 5XXXXXXXX" required>
                        @error('acc_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gender <span class="text-danger">*</span></label>
                        <select class="form-select @error('acc_gender') is-invalid @enderror" name="acc_gender" required>
                            <option value="Male" {{ old('acc_gender', $user->acc_gender) == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('acc_gender', $user->acc_gender) == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('acc_gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('acc_address') is-invalid @enderror" name="acc_address" value="{{ old('acc_address', $user->acc_address) }}" required>
                        @error('acc_address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Age</label>
                        <input type="number" class="form-control @error('acc_age') is-invalid @enderror" name="acc_age" value="{{ old('acc_age', $user->acc_age) }}">
                        @error('acc_age') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Do you smoke?</label>
                        <select class="form-select @error('acc_smoking') is-invalid @enderror" name="acc_smoking">
                            <option value="">-- Select --</option>
                            <option value="1" {{ old('acc_smoking', $user->acc_smoking) == '1' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('acc_smoking', $user->acc_smoking) == '0' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('acc_smoking') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Employment Status</label>
                        <input type="text" class="form-control @error('acc_status') is-invalid @enderror" name="acc_status" value="{{ old('acc_status', $user->acc_status) }}">
                        @error('acc_status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password (optional)</label>
                        <input type="password" class="form-control @error('acc_password') is-invalid @enderror" name="acc_password" placeholder="Leave blank to keep current password">
                        @error('acc_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control @error('acc_password_confirmation') is-invalid @enderror" name="acc_password_confirmation" placeholder="Confirm new password">
                        @error('acc_password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Update Profile</button>
                </form>

            </div>
        </div>
    </div>
@endsection
