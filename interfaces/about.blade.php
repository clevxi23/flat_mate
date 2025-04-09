@extends('website.layouts.app')

@section('title', 'About Us')

@section('content')

    <!-- Hero Section -->
    <div class="hero page-inner overlay" style="background-image: url('{{ asset('assets/images/hero_bg_3.jpg') }}')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading text-white" data-aos="fade-up">About Us</h1>
                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">About</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <div class="section mb-5">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-8 mb-4" data-aos="fade-right">
                    <h2 class="text-primary mb-3">Who We Are</h2>
                    <p class="text-black-50">
                        FlatMate is a trusted platform designed to help individuals **find the perfect roommate, rent properties, and manage listings effortlessly**.
                        Whether you’re searching for a new place to live, listing a property, or looking for the right tenant, we make the process simple, safe, and stress-free.
                    </p>
                    <p class="text-black-50">
                        With our **advanced matching system, verified listings, and dedicated support team**, we ensure a seamless and secure experience for all our users.
                    </p>
                </div>
                <div class="col-lg-4" data-aos="fade-left">
                    <img src="{{ asset('img/who.png') }}" class="img-fluid">
                </div>
            </div>

            <div class="row align-items-center mb-5">
                <div class="col-lg-6 order-lg-2 mb-4" data-aos="fade-left">
                    <h2 class="text-primary mb-3">Our Mission</h2>
                    <p class="text-black-50">
                        Our mission is to **redefine the roommate and rental experience** by providing a secure and user-friendly platform where people can find trusted roommates, verified rental spaces, and property management solutions.
                    </p>
                    <p class="text-black-50">
                        We aim to bridge the gap between house seekers and property owners while ensuring **transparency, affordability, and convenience**.
                    </p>
                </div>
                <div class="col-lg-6 order-lg-1" data-aos="fade-right">
                    <img src="{{ asset('img/mission.webp') }}" class="img-fluid ">
                </div>
            </div>

            <div class="row text-center mb-5">
                <h2 class="text-primary">Why Choose FlatMate?</h2>
            </div>

            <div class="row text-center mb5">
                <div class="col-lg-4 mb-4" data-aos="fade-up">
                    <div class="p-4 border rounded shadow">
                        <i class="fa-solid fa-users fa-3x text-primary mb-3"></i>
                        <h4>Verified Roommates</h4>
                        <p class="text-black-50">We ensure every user is verified, making it safer to find and live with roommates.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="p-4 border rounded shadow">
                        <i class="fa-solid fa-house-user fa-3x text-primary mb-3"></i>
                        <h4>Quality Rentals</h4>
                        <p class="text-black-50">Our platform features only well-maintained and approved rental properties.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="p-4 border rounded shadow">
                        <i class="fa-solid fa-shield-alt fa-3x text-primary mb-3"></i>
                        <h4>Secure Transactions</h4>
                        <p class="text-black-50">We prioritize security by offering a safe and reliable payment system.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
