@extends('website.layouts.app')

@section('title', 'Register - Choose Your Role')


@section('content')

    <div class="hero page-inner overlay d-flex align-items-center" style="background-image: url('{{ asset('assets/images/hero_bg_1.jpg') }}'); min-height: 400px;">
        <div class="container text-center text-white">
            <h1 class="display-4 text-white fw-bold">Join FlatMate</h1>
        </div>
    </div>

    <div class="register-container">
        <div class="container text-center">
            <h2 class="mb-4">Join FlatMate – Select Your Role</h2>
            <div class="row justify-content-center">
                <!-- House Owner Box -->
                <div class="col-md-5">
                    <div class="register-box">
                        <i class="fas fa-home"></i>
                        <h3>House Owner</h3>
                        <p>List your properties and connect with potential tenants.</p>
                        <a href="{{ route('website.register_owner') }}" class="btn btn-primary">Register as Owner</a>
                    </div>
                </div>

                <!-- Roommate Box -->
                <div class="col-md-5">
                    <div class="register-box">
                        <i class="fas fa-user-friends"></i>
                        <h3>Roommate</h3>
                        <p>Find compatible roommates and shared properties.</p>
                        <a href="{{ route('website.register_roommate') }}" class="btn btn-primary">Register as Roommate</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
