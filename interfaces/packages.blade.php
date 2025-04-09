@extends('website.layouts.app')

@section('title', 'Subscription Packages')

@section('content')

    <div class="hero page-inner overlay" style="background-image: url('{{ asset('assets/images/hero_bg_1.jpg') }}')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading" data-aos="fade-up">Our Package planes</h1>
                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">Contact</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container section py-5">
        <h2 class="text-center text-primary fw-bold">Choose the Best Plan for You</h2>
        <p class="text-center text-muted">Pick a plan that best suits your needs and start connecting with roommates today.</p>

        <div class="row justify-content-center mt-4">
            <!-- Beginner Package -->
            <div class="col-md-4">
                <div class="card shadow-sm p-4 text-center">
                    <i class="fas fa-star fa-3x text-primary mb-3"></i>
                    <h4 class="fw-bold">Beginner Plan</h4>
                    <p class="text-muted">Perfect for those just starting out.</p>
                    <h3 class="fw-bold text-primary">500 SAR</h3>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success"></i> Basic Listing</li>
                        <li><i class="fas fa-check text-success"></i> Limited Visibility</li>
                        <li><i class="fas fa-times text-danger"></i> No Priority Support</li>
                    </ul>
                    <button class="btn btn-primary w-100">Subscribe</button>
                </div>
            </div>

            <!-- Mid Package -->
            <div class="col-md-4">
                <div class="card shadow-sm p-4 text-center">
                    <i class="fas fa-rocket fa-3x text-success mb-3"></i>
                    <h4 class="fw-bold">Mid Plan</h4>
                    <p class="text-muted">Ideal for expanding your reach.</p>
                    <h3 class="fw-bold text-success">1,000 SAR</h3>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success"></i> Standard Listing</li>
                        <li><i class="fas fa-check text-success"></i> Medium Visibility</li>
                        <li><i class="fas fa-check text-success"></i> Email Support</li>
                    </ul>
                    <button class="btn btn-success w-100">Subscribe</button>
                </div>
            </div>

            <!-- Professional Package -->
            <div class="col-md-4">
                <div class="card shadow-sm p-4 text-center">
                    <i class="fas fa-crown fa-3x text-warning mb-3"></i>
                    <h4 class="fw-bold">Professional Plan</h4>
                    <p class="text-muted">For the ultimate renting experience.</p>
                    <h3 class="fw-bold text-warning">2,000 SAR</h3>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success"></i> Premium Listing</li>
                        <li><i class="fas fa-check text-success"></i> Maximum Visibility</li>
                        <li><i class="fas fa-check text-success"></i> Priority Support</li>
                    </ul>
                    <button class="btn btn-warning w-100">Subscribe</button>
                </div>
            </div>
        </div>
    </div>
@endsection

