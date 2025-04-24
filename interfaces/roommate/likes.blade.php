@extends('website.layouts.app')

@section('title', 'My Liked Units')

@push('css')
    <style>
        .unit-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 3px 6px rgba(0,0,0,0.05);
        }
    </style>
@endpush

@section('content')

    <div class="hero page-inner overlay" style="background-image: url('{{ asset('assets/images/hero_bg_3.jpg') }}')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading text-white" data-aos="fade-up">My Likes</h1>
                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">My Likes</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container dashboard-content mt-5 mb-4">
        <div class="profile-container">
            <h3 class="mb-4">My Liked Units</h3>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($likes->count() > 0)
                @foreach($likes as $like)
                    @if($like->unitAd)
                        <div class="unit-card">
                            <h5>{{ $like->unitAd->ua_address }}</h5>
                            <p>Rent: {{ number_format($like->unitAd->ua_rent_fees) }} <img height="14px" src="{{ asset('sar.png') }}"></p>
                            <p>Size: {{ $like->unitAd->ua_size }} sqm</p>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('website.unit_ad_single', $like->unitAd->ua_id) }}" class="btn btn-primary py-2 px-3">See Details</a>

                                <div class="mt-2 d-flex align-items-center gap-1">

                                    <form method="POST" action="{{ route('roommate.unit.like', $like->unitAd->ua_id) }}">
                                        @csrf
                                        <button type="submit" class="btn p-0 border-0 bg-transparent d-flex align-items-center">
                                            <i class="fas fa-heart me-1 {{ $like->unitAd->likes->contains('acc_id', auth()->id()) ? 'text-danger' : 'text-secondary' }}"></i>
                                            <span class="small">
                {{ $like->unitAd->likes->contains('acc_id', auth()->id()) ? 'Unlike' : 'Like' }}
            </span>
                                        </button>
                                    </form>
                                    <span class="small text-muted ms-1">({{ $like->unitAd->likes->count() }})</span>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <p class="text-muted">You haven't liked any units yet.</p>
            @endif
        </div>
    </div>
@endsection
