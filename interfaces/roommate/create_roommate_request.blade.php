@extends('website.layouts.app')

@section('title', 'Create Roommate Request')

@push('css')
    <style>
        .request-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }
        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .form-control, .form-select {
            border-radius: 8px;
            padding: 10px;
            font-size: 1rem;
        }
        .row-cols-2 .col {
            padding: 0 10px;
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <div class="hero page-inner overlay" style="background-image: url('{{ asset('assets/images/hero_bg_3.jpg') }}')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading text-white" data-aos="fade-up">Create Roommate Request</h1>
                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">Create Roommate Request</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Roommate Request Form -->
    <div class="container mt-5 mb-5">
        <div class="request-container">
            <h3 class="mb-4 text-center" style="color: #f39f84;">Post a Roommate Request</h3>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Unit Ad Brief Details -->
            <div class="unit-details">
                <h5 class="fw-bold text-primary">{{ $unitAd->ua_title }}</h5>
                <p><i class="fas fa-map-marker-alt"></i> <strong>Location:</strong> {{ $unitAd->ua_address }}</p>
                <p><i class="fas fa-money-bill-wave"></i> <strong>Rent:</strong> {{ number_format($unitAd->ua_rent_fees) }} SAR / Month</p>
                <p><i class="fas fa-ruler-combined"></i> <strong>Size:</strong> {{ $unitAd->ua_size }} sqm</p>
                <p><i class="fas fa-users"></i> <strong>Max Roommates:</strong> {{ $unitAd->ua_num_of_roommates ?? 'Not specified' }}</p>
                <p><i class="fas fa-smoking-ban"></i> <strong>Smoking:</strong> {{ $unitAd->ua_smoking_allowed ? 'Yes' : 'No' }}</p>
                <p><i class="fas fa-paw"></i> <strong>Pets:</strong> {{ $unitAd->ua_pets_allowed ? 'Yes' : 'No' }}</p>
                <p><i class="fas fa-dumbbell"></i> <strong>Facilities:</strong> {{ $unitAd->facilities->pluck('fac_title')->implode(', ') ?: 'None' }}</p>
            </div>

            <form action="{{ route('roommate.request.store', $unitAd->ua_id) }}" method="POST">
                @csrf
                <input type="hidden" name="ua_id" value="{{ $unitAd->ua_id }}">

                <div class="mb-4">
                    <label class="form-label">Description <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('roommate_req_des') is-invalid @enderror" name="roommate_req_des" rows="4" placeholder="Describe what you're looking for in a roommate..." required>{{ old('roommate_req_des') }}</textarea>
                    @error('roommate_req_des')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row row-cols-2 mb-4">
                    <div class="col">
                        <label class="form-label">Preferred Gender <span class="text-danger">*</span></label>
                        <select class="form-select @error('roommate_req_gender') is-invalid @enderror" name="roommate_req_gender" required>
                            <option value="Male" {{ old('roommate_req_gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('roommate_req_gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('roommate_req_gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label class="form-label">Preferred Age Range <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('roommate_req_age') is-invalid @enderror" name="roommate_req_age" value="{{ old('roommate_req_age') }}" placeholder="e.g., 20-30" required>
                        @error('roommate_req_age')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row row-cols-2 mb-4">
                    <div class="col">
                        <label class="form-label">Employment Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('roommate_req_emp_status') is-invalid @enderror" name="roommate_req_emp_status" required>
                            <option value="Employed" {{ old('roommate_req_emp_status') == 'Employed' ? 'selected' : '' }}>Employed</option>
                            <option value="Student" {{ old('roommate_req_emp_status') == 'Student' ? 'selected' : '' }}>Student</option>
                            <option value="Unemployed" {{ old('roommate_req_emp_status') == 'Unemployed' ? 'selected' : '' }}>Unemployed</option>
                        </select>
                        @error('roommate_req_emp_status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label class="form-label">Number of Roommates <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('roommate_req_num_of_roommate') is-invalid @enderror" name="roommate_req_num_of_roommate" value="{{ old('roommate_req_num_of_roommate') }}" min="1" max="{{ $unitAd->ua_num_of_roommates }}" required>
                        <small class="text-muted">Max: {{ $unitAd->ua_num_of_roommates }}</small>
                        @error('roommate_req_num_of_roommate')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row row-cols-2 mb-4">
                    <div class="col">
                        <label class="form-label">Smoking Preference <span class="text-danger">*</span></label>
                        <select class="form-select @error('roommate_req_smoking') is-invalid @enderror" name="roommate_req_smoking" required>
                            <option value="1" {{ old('roommate_req_smoking') == 'Yes' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('roommate_req_smoking') == 'No' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('roommate_req_smoking')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label class="form-label">Children Allowed <span class="text-danger">*</span></label>
                        <select class="form-select @error('roommate_req_child') is-invalid @enderror" name="roommate_req_child" required>
                            <option value="1" {{ old('roommate_req_child') == 'Yes' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('roommate_req_child') == 'No' ? 'selected' : '' }}>No</option>
                        </select>
                        @error('roommate_req_child')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Pets Allowed <span class="text-danger">*</span></label>
                    <select class="form-select @error('roommate_req_pets_ref') is-invalid @enderror" name="roommate_req_pets_ref" required>
                        <option value="1" {{ old('roommate_req_pets_ref') == 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('roommate_req_pets_ref') == 'No' ? 'selected' : '' }}>No</option>
                    </select>
                    @error('roommate_req_pets_ref')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">Submit Request</button>
            </form>
        </div>
    </div>
@endsection
