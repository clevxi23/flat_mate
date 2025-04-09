@extends('website.layouts.app')

@section('title', 'Find Your Perfect Roommate & Home')

@push('css')
    <style>
        .filter-tags .tag {
            background: #e9ecef;
            padding: 5px 10px;
            border-radius: 20px;
            margin-right: 10px;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
        }
        .filter-tags .tag .remove-tag {
            cursor: pointer;
            margin-left: 5px;
            color: #dc3545;
        }
    </style>
@endpush

@section('content')

    <!-- Hero Section -->
    <div class="hero page-inner overlay" style="background-image: url('{{ asset('assets/images/hero_bg_1.jpg') }}')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading text-white" data-aos="fade-up">Find Your Perfect Roommate & Home</h1>
                    <p class="text-white-50 mt-3" data-aos="fade-up" data-aos-delay="200">
                        Search for the best rooms and roommates that match your lifestyle.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Search Area -->
    <div class="section bg-light py-4 shadow-sm">
        <div class="container">
            <form action="{{ route('website.home') }}" method="GET" class="search-box d-flex align-items-center justify-content-center gap-3">
                <!-- Main Location Search -->
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-map-marker-alt text-primary"></i></span>
                        <input type="text" class="form-control border rounded-3" name="room_address" placeholder="Enter city or area..." value="{{ request('room_address') }}">
                    </div>
                </div>
                <!-- Filter Button -->
                <button type="button" class="btn btn-outline-primary rounded-3 d-flex align-items-center" data-bs-toggle="offcanvas" data-bs-target="#filterSidebar">
                    <i class="fas fa-filter me-2"></i> Filters
                </button>
                <!-- Search Button -->
                <button type="submit" class="btn btn-primary rounded-3 px-4">
                    <i class="fas fa-search"></i> Search
                </button>
            </form>

            <!-- Selected Filters as Tags -->
            @if(request()->query())
                <div class="filter-tags mt-3 text-center">
                    @foreach(request()->query() as $key => $value)
                        @if($value && !in_array($key, ['page'])) <!-- Exclude pagination parameter -->
                        <span class="tag">
                                {{ ucfirst(str_replace('_', ' ', $key)) }}: {{ $value }}
                                <a href="{{ route('website.unit_ads', request()->except($key)) }}" class="remove-tag">
                                    <i class="fas fa-times"></i>
                                </a>
                            </span>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Left Sliding Filter Sidebar -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="filterSidebar">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title"><i class="fas fa-sliders-h"></i> Advanced Filters</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form action="{{ route('website.unit_ads') }}" method="GET">
                <div class="row gy-3">
                    <!-- Max Price -->
                    <div class="col-md-12">
                        <label for="room_price" class="form-label"><i class="fas fa-money-bill-wave"></i> Max Price (SAR)</label>
                        <input type="number" class="form-control" name="room_price" placeholder="e.g. 5000" value="{{ request('room_price') }}">
                    </div>
                    <!-- Room Size -->
                    <div class="col-md-12">
                        <label for="room_size" class="form-label"><i class="fas fa-ruler-combined"></i> Room Size (sqm)</label>
                        <input type="number" class="form-control" name="room_size" placeholder="e.g. 50" value="{{ request('room_size') }}">
                    </div>
                    <!-- Room Type -->
                    <div class="col-md-12">
                        <label for="room_type" class="form-label"><i class="fas fa-home"></i> Room Type</label>
                        <select class="form-select" name="room_type">
                            <option value="">Any</option>
                            <option value="Studio" {{ request('room_type') == 'Studio' ? 'selected' : '' }}>Studio</option>
                            <option value="Shared" {{ request('room_type') == 'Shared' ? 'selected' : '' }}>Shared</option>
                            <option value="Single" {{ request('room_type') == 'Single' ? 'selected' : '' }}>Single</option>
                        </select>
                    </div>
                    <!-- Gender Preference -->
                    <div class="col-md-12">
                        <label for="room_gender_pref" class="form-label"><i class="fas fa-user"></i> Gender Preference</label>
                        <select class="form-select" name="room_gender_pref">
                            <option value="">Any</option>
                            <option value="Male" {{ request('room_gender_pref') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ request('room_gender_pref') == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <!-- Pets Allowed -->
                    <div class="col-md-12">
                        <label for="room_pets_allowed" class="form-label"><i class="fas fa-paw"></i> Pets Allowed</label>
                        <select class="form-select" name="room_pets_allowed">
                            <option value="">Any</option>
                            <option value="Yes" {{ request('room_pets_allowed') == 'Yes' ? 'selected' : '' }}>Yes</option>
                            <option value="No" {{ request('room_pets_allowed') == 'No' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                    <!-- Smoking Allowed -->
                    <div class="col-md-12">
                        <label for="room_smoking_allowed" class="form-label"><i class="fas fa-smoking"></i> Smoking Allowed</label>
                        <select class="form-select" name="room_smoking_allowed">
                            <option value="">Any</option>
                            <option value="Yes" {{ request('room_smoking_allowed') == 'Yes' ? 'selected' : '' }}>Yes</option>
                            <option value="No" {{ request('room_smoking_allowed') == 'No' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                    <!-- Number of Roommates -->
                    <div class="col-md-12">
                        <label for="room_numofroommates" class="form-label"><i class="fas fa-users"></i> No. of Roommates</label>
                        <input type="number" class="form-control" name="room_numofroommates" placeholder="e.g. 3" value="{{ request('room_numofroommates') }}">
                    </div>
                    <!-- Lease Term -->
                    <div class="col-md-12">
                        <label for="room_lease_term" class="form-label"><i class="fas fa-calendar-alt"></i> Lease Term (months)</label>
                        <input type="number" class="form-control" name="room_lease_term" placeholder="e.g. 12" value="{{ request('room_lease_term') }}">
                    </div>
                    <!-- Search Button -->
                    <div class="col-md-12 text-center mt-3">
                        <button type="submit" class="btn btn-primary px-4 py-2">
                            <i class="fas fa-search"></i> Apply Filters
                        </button>
                        <button type="reset" class="btn btn-outline-secondary px-4 py-2">
                            <i class="fas fa-sync-alt"></i> Reset
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Unit Ads Listing -->
    <div class="section section-unit-ads">
        <div class="container">
            <div class="row">
                @forelse($unitAds as $unitAd)
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="property-item position-relative mb-30">
                            @if($unitAd->account && $unitAd->account->subscriptions && optional($unitAd->account->subscriptions->last())->sub_end_date > now())
                                <div class="badge bg-warning text-dark  pre_add top-0 start-0 m-2 px-3 py-1" style="z-index:10;">
                                    <i class="fas fa-star text-white me-1"></i> Premium Ad
                                </div>
                            @endif

                            <a href="{{ route('website.unit_ad_single', $unitAd->ua_id) }}" class="img">
                                <img src="{{ $unitAd->images->first() ? asset($unitAd->images->first()->image_url) :
 asset('img/about.png') }}" alt="Unit Ad Image" class="img-fluid">
                            </a>
                            <div class="property-content">
                                <div class="price mb-2"><span>{{ number_format($unitAd->ua_rent_fees) }}
                                        <img height="15px" src="{{asset('sar.png')}}"></span></div>
                                <div>
                                    <span class="d-block mb-2 text-black-50">{{ $unitAd->ua_address }}</span>
                                    <span class="d-block text-primary">Size: {{ $unitAd->ua_size }} sqm</span>
                                    <div class="specs d-flex mb-4">
                                        <span class="d-block d-flex align-items-center me-3">
                                            <span class="icon-bed me-2"></span>
                                            <span class="caption">{{ $unitAd->ua_num_of_bedrooms }} beds</span>
                                        </span>
                                        <span class="d-block d-flex align-items-center">
                                            <span class="icon-bath me-2"></span>
                                            <span class="caption">{{ $unitAd->ua_num_of_bathrooms ?? 1 }} baths</span>
                                        </span>
                                    </div>
                                    <p class="text-muted">
                                        Gender Preference: {{ $unitAd->ua_gender_pref ?? 'Any' }} |
                                        Pets: {{ $unitAd->ua_pets_allowed }} |
                                        Smoking: {{ $unitAd->ua_smoking_allowed }}
                                    </p>
                                    <a href="{{ route('website.unit_ad_single', $unitAd->ua_id) }}" class="btn btn-primary py-2 px-3">See Details</a>
                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No unit ads found matching your criteria.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="row align-items-center py-5">
                <div class="col-lg-3">Showing {{ $unitAds->firstItem() }} - {{ $unitAds->lastItem() }} of {{ $unitAds->total() }} unit ads</div>
                <div class="col-lg-6 text-center">
                    <div class="custom-pagination">
                        @if($unitAds->onFirstPage())
                            <a href="javascript::(0)" class="active">1</a>
                        @else
                            <a href="{{ $unitAds->previousPageUrl() . '&' . http_build_query(request()->except('page')) }}" class="{{ $unitAds->currentPage() == 1 ? 'active' : '' }}">1</a>
                        @endif
                        @for($i = 2; $i <= $unitAds->lastPage(); $i++)
                            <a href="{{ $unitAds->url($i) . '&' . http_build_query(request()->except('page')) }}" class="{{ $unitAds->currentPage() == $i ? 'active' : '' }}">{{ $i }}</a>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
