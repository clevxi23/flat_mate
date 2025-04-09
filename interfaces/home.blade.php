@extends('website.layouts.app')

@section('content')

    <!-- Hero Section -->
    <div class="hero">
        <div class="hero-slide">
            <div class="img overlay" style="background-image: url('{{ asset('assets/images/hero_bg_3.jpg') }}')"></div>
            <div class="img overlay" style="background-image: url('{{ asset('assets/images/hero_bg_2.jpg') }}')"></div>
            <div class="img overlay" style="background-image: url('{{ asset('assets/images/hero_bg_1.jpg') }}')"></div>
        </div>

        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center">
                    <h1 class="heading" data-aos="fade-up">
                        Find Your Perfect Roommate & Home
                    </h1>
                    <form action="#" class="narrow-w form-search d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="200">
                        <input type="text" class="form-control px-4" placeholder="Enter your location (e.g., New York)" />
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Section: How It Works -->
    <div class="section bg-light">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-lg-12">
                    <h2 class="font-weight-bold text-primary heading">How It Works</h2>
                    <p class="text-muted">A seamless experience for Roommates, House Owners, and Admins.</p>
                </div>
            </div>

            <div class="row">
                <!-- Roommate Section -->
                <div class="col-md-4" data-aos="fade-up">
                    <div class="feature-box text-center">
                        <i class="fa-solid font-sizee-50 fa-handshake"></i>
                        <h3>Find a Roommate</h3>
                        <p>Search for compatible roommates based on your preferences.</p>
                        <p><a href="{{ url('/roommates') }}" class="learn-more">Learn More</a></p>
                    </div>
                </div>

                <!-- House Owner Section -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-box text-center">
                        <span class="flaticon-building font-sizee-50 icon mb-4"></span>
                        <h3>List Your Property</h3>
                        <p>House owners can list their properties and connect with potential tenants.</p>
                        <p><a href="{{ url('/house-owners') }}" class="learn-more">Learn More</a></p>
                    </div>
                </div>

                <!-- Admin Section -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-box text-center">
                        <i class="fa-solid font-sizee-50 fa-shield-halved"></i>
                        <h3>Admin Dashboard</h3>
                        <p>Manage users, listings, and payments securely from the admin panel.</p>
                        <p><a href="{{ url('/admin') }}" class="learn-more">Learn More</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End How It Works -->

    <!-- Popular Properties -->
    <div class="section">
        <div class="container">
            <div class="row mb-5 align-items-center">
                <div class="col-lg-6">
                    <h2 class="font-weight-bold text-primary heading">premium ads </h2>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <p>
                        <a href="{{ route('website.unit_ads') }}" class="btn btn-primary text-white py-3 px-4">View all Units</a>
                    </p>
                </div>
            </div>

            <div class="row">
                @forelse($premiumAds as $unitAd)
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
                    <div class="col-12 text-center text-muted">No premium ads available now.</div>
                @endforelse
            </div>

        </div>
    </div>
    <!-- End Popular Properties -->

    <!-- Call to Action -->
    <div class="section text-center bg-light py-5 mb-5">
        <div class="container">
            <h2 class="text-primary mb-4">Join Our Community</h2>
            <p class="mb-4">Find a roommate, rent a property, or manage listings with ease.</p>
            <a href="{{ url('/register') }}" class="btn btn-primary px-4 py-3">Get Started</a>
        </div>
    </div>
    <!-- End Call to Action -->


    <!-- Subscription Packages Section -->
    <section class="py-5 bg-light">
        <div class="container text-center">
            <h2 class="text-primary fw-bold mb-4">Boost Your Listing with Our Packages</h2>
            <p class="text-muted mb-4">Enhance visibility and connect with potential roommates faster by choosing the right subscription package.</p>

            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow-sm p-4">
                        <i class="fas fa-star fa-3x text-primary mb-3"></i>
                        <h4>Beginner</h4>
                        <p>Start your journey with essential listing features.</p>
                        <a href="{{ route('website.packages') }}" class="btn btn-outline-primary">Read More</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm p-4">
                        <i class="fas fa-rocket fa-3x text-success mb-3"></i>
                        <h4>Mid</h4>
                        <p>Unlock additional features and reach more renters.</p>
                        <a href="{{ route('website.packages') }}" class="btn btn-outline-success">Read More</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm p-4">
                        <i class="fas fa-crown fa-3x text-warning mb-3"></i>
                        <h4>Professional</h4>
                        <p>Get full access with priority listing & premium features.</p>
                        <a href="{{ route('website.packages') }}" class="btn btn-outline-warning">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
