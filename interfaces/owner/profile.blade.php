@extends('website.layouts.app_owner')

@section('title', 'My Profile')

@push('css')
    <style>
        .profile-container {
            max-width: 100%;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            gap: 30px;
        }

        .profile-sidebar {
            width: 250px;
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .profile-sidebar .nav-tabs {
            flex-direction: column;
            border: none;
        }

        .profile-sidebar .nav-tabs .nav-link {
            text-align: left;
            padding: 12px;
            font-size: 16px;
            color: #333;
            border-radius: 5px;
            transition: 0.3s;
            border: none;
        }

        .profile-sidebar .nav-tabs .nav-link.active {
            background: #ffd5c4;
            color: white;
            font-weight: bold;
        }
        .profile-content {
            flex: 1;
        }

        .form-label {
            font-weight: bold;
        }

        .subscription-info {
            padding: 15px;
            border-radius: 8px;
        }
    </style>
@endpush

@section('content')
    <div class="container dashboard-content py-4">
        <div class="profile-container">
            <!-- Sidebar Navigation -->
            <div class="profile-sidebar">
                <ul class="nav nav-tabs" id="profileTabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#update-info"><i class="fas fa-user-edit"></i> Update Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#change-password"><i class="fas fa-lock"></i> Change Password</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#my-subscription"><i class="fas fa-box"></i> My Subscription</a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="profile-content">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="tab-content">
                    <!-- Update Information -->
                    <div id="update-info" class="tab-pane fade show active">
                        <h4 class="mb-3 text-primary"><i class="fas fa-user-edit"></i> Update Information</h4>
                        <form action="{{ route('owner.profile.update') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control @error('acc_name') is-invalid @enderror" name="acc_name" value="{{ old('acc_name', $account->acc_name) }}" required>
                                @error('acc_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email <strong class="text-danger">*</strong></label>
                                <input type="email" class="form-control @error('acc_email') is-invalid @enderror" name="acc_email" value="{{ old('acc_email', $account->acc_email) }}" required>
                                @error('acc_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone <strong class="text-danger">*</strong></label>
                                <input type="text" class="form-control @error('acc_phone') is-invalid @enderror" name="acc_phone" value="{{ old('acc_phone', $account->acc_phone) }}" required>
                                <small class="form-text text-muted">Format: 05XXXXXXXX or +9665XXXXXXXX</small>
                                @error('acc_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control @error('acc_address') is-invalid @enderror" name="acc_address" value="{{ old('acc_address', $account->acc_address) }}">
                                @error('acc_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn2"><i class="fas fa-save"></i> Update Information</button>
                        </form>
                    </div>

                    <!-- Change Password -->
                    <div id="change-password" class="tab-pane fade">
                        <h4 class="mb-3 text-primary"><i class="fas fa-lock"></i> Change Password</h4>
                        <form action="{{ route('owner.profile.password') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Current Password <strong class="text-danger">*</strong></label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required>
                                @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">New Password <strong class="text-danger">*</strong></label>
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required>
                                <small class="form-text text-muted">At least 8 characters, including letters, numbers, and special characters.</small>
                                @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm New Password <strong class="text-danger">*</strong></label>
                                <input type="password" class="form-control" name="new_password_confirmation" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn2"><i class="fas fa-key"></i> Change Password</button>
                        </form>
                    </div>

                    <!-- My Subscription -->
                    <div id="my-subscription" class="tab-pane fade">
                        <h4 class="text-primary"><i class="fas fa-box"></i> My Subscription</h4>
                        <div class="subscription-info">
                            <p><strong>Package:</strong> Premium Plan</p>
                            <p><strong>Amount Paid:</strong> 1,500 SAR</p>
                            <p><strong>Start Date:</strong> 01 Jan 2024</p>
                            <p><strong>End Date:</strong> 01 Jan 2025</p>
                            <p><strong>Status:</strong> <span class="badge bg-success">Active</span></p>
                            <a href="{{route('owner.subscribe')}}" class="btn btn-primary btn2 mt-3"><i class="fas fa-sync"></i> Upgrade Subscription</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
