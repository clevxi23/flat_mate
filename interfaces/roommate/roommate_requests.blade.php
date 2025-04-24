@extends('website.layouts.app')

@section('title', 'My Roommate Requests')

@push('css')
    <style>
        .dashboard-content {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <div class="hero page-inner overlay" style="background-image: url('{{ asset('assets/images/hero_bg_3.jpg') }}')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading text-white" data-aos="fade-up">My Roommate Requests</h1>
                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">My Roommate Requests</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container section dashboard-content">
        <h2 class="mb-4 text-center" style="color: #f7885f; font-weight: 600;">My Roommate Requests</h2>
        <div class="request-table">
            <table id="dataTable" class="table table-bordered table-hover text-center">
                <thead>
                <tr>
                    <th>Request Number</th>
                    <th>Location</th>
                    <th>Gender</th>
                    <th>Roommates Needed</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($requests as $request)
                    <tr>
                        <td>{{ $request->roommate_req_id }}</td>
                        <td>{{ $request->unitAd->ua_address }}</td>
                        <td>{{ $request->roommate_req_gender }}</td>
                        <td>{{ $request->roommate_req_num_of_roommate }}</td>
                        <td>
                                <span class="status-badge text-danger status-{{ strtolower($request->req_status) }}">
                                    {{ $request->req_status }}
                                </span>
                        </td>
                        <td>
                            <a href="{{ route('roommate.applications.list', $request->roommate_req_id) }}"
                               class="btn btn2 btn-primary mb-3">View All Applications
                            </a>
                            <a href="{{ route('roommate.request.show', $request->roommate_req_id) }}" class="btn btn2 btn-details">
                                <i class="fas fa-eye"></i> Details
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">You have no roommate requests yet.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

