@extends('website.layouts.app_owner')

@section('title', 'Unit Ad Details')

@section('content')
    <div class="container dashboard-content py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Unit Ad #{{ $unitAd->ua_id }} - {{ $unitAd->ua_address }}</h5>
                <a href="{{ route('owner.unit_ads.index') }}" class="btn btn-light btn-sm">
                    Back <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <div class="card-body">
                <!-- Basic Unit Information -->
                <div class="mb-4">
                    <h5 class="text-primary border-bottom pb-2">Basic Information</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong>Address:</strong> {{ $unitAd->ua_address }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Type:</strong> {{ $unitAd->ua_type }}
                        </div>
                        <div class="col-md-4 mb-3">
                            <strong>Size:</strong> {{ $unitAd->ua_size }} sqm
                        </div>
                        <div class="col-md-4 mb-3">
                            <strong>Rent Duration:</strong> {{ $unitAd->ua_rent_duration }}
                        </div>
                        <div class="col-md-4 mb-3">
                            <strong>Rent Fees:</strong> {{ number_format($unitAd->ua_rent_fees, 2) }} SAR
                        </div>
                        <div class="col-md-4 mb-3">
                            <strong>Availability Date:</strong> {{ $unitAd->ua_availability_start_date }}
                        </div>
                        <div class="col-md-4 mb-3">
                            <strong>Lease Term:</strong> {{ $unitAd->ua_lease_term }}
                        </div>
                        <div class="col-md-4 mb-3">
                            <strong>Unit Age:</strong> {{ $unitAd->ua_age }} years
                        </div>
                    </div>
                </div>

                <!-- Room Details -->
                <div class="mb-4">
                    <h5 class="text-primary border-bottom pb-2">Room Details</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong>Number of Roommates:</strong> {{ $unitAd->ua_num_of_roommates }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Number of Bedrooms:</strong> {{ $unitAd->ua_num_of_bedrooms }}
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <h5 class="text-primary border-bottom pb-2">Description</h5>
                    <p>{{ $unitAd->ua_description }}</p>
                </div>

                <!-- Preferences -->
                <div class="mb-4">
                    <h5 class="text-primary border-bottom pb-2">Preferences</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong>Pets Allowed:</strong>
                            <span class="badge {{ $unitAd->ua_pets_allowed ? 'bg-success' : 'bg-danger' }} text-white">
                                {{ $unitAd->ua_pets_allowed ? 'Yes' : 'No' }}
                            </span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Smoking Allowed:</strong>
                            <span class="badge {{ $unitAd->ua_smoking_allowed ? 'bg-success' : 'bg-danger' }} text-white">
                                {{ $unitAd->ua_smoking_allowed ? 'Yes' : 'No' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Images -->
                <div class="mb-4">
                    <h5 class="text-primary border-bottom pb-2">Images</h5>
                    @if($unitAd->images->isEmpty())
                        <p class="text-muted">No images available.</p>
                    @else
                        <div class="row">
                            @foreach($unitAd->images as $image)
                                <div class="col-md-3 mb-3">
                                    <img src="{{ asset($image->image_url) }}" class="img-fluid rounded shadow-sm" alt="Unit Image">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Facilities -->
                <div class="mb-4">
                    <h5 class="text-primary border-bottom pb-2">Facilities</h5>
                    @if($unitAd->facilities->isEmpty())
                        <p class="text-muted">No facilities listed.</p>
                    @else
                        <ul class="list-group">
                            @foreach($unitAd->facilities as $facility)
                                <li class="list-group-item">
                                    <strong>{{ $facility->fac_title }}</strong>
                                    @if($facility->fac_description)
                                        <p class="mb-0 text-muted">{{ $facility->fac_description }}</p>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
