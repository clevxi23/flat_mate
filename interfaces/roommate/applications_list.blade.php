@extends('website.layouts.app')

@section('title', 'My Roommate Applications')

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
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            color: white;
            display: inline-block;
            min-width: 80px;
        }
        .status-pending { background: #ffc107; color: #333; }
        .status-accepted { background: #28a745; }
        .status-rejected { background: #dc3545; }
        .btn-action {
            padding: 6px 12px;
            font-size: 0.9rem;
            margin: 0 4px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }
        .btn-details {
            background: #c76d4c;
            color: white;
        }
        .btn-details:hover {
            background: #c76d4c;
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <div class="hero page-inner overlay" style="background-image: url('{{ asset('assets/images/hero_bg_3.jpg') }}')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading text-white" data-aos="fade-up">My Roommate Applications</h1>
                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('roommate.requests') }}">My Requests</a></li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">Applications</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container section dashboard-content">
        <h2 class="mb-4 text-center" style="font-weight: 600;">Applications For Request Number #{{$req->roommate_req_id}}</h2>
        <div class="applications-table">
            <table id="dataTable" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Application ID</th>
                    <th>Applicant Name</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>Unit Location</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($applications as $application)
                    <tr>
                        <td>{{ $application->app_id }}</td>
                        <td>{{optional( $application->account)->acc_name }}</td>
                        <td>{{ optional($application->account)->acc_phone ?? 'N/A' }}</td>
                        <td>{{ optional($application->account)->acc_gender }}</td>
                        <td>{{ optional($application->roommateRequest->unitAd)->ua_address }}</td>
                        <td>
                                <span class="status-badge status-{{ strtolower($application->app_status) }}">
                                    {{ $application->app_status }}
                                </span>
                        </td>
                        <td>
                            @if($application->app_status == 'Pending')
                                <form action="{{ route('roommate.application.accept', $application->app_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn2 btn-success btn-action accept-btn" data-id="{{ $application->app_id }}">
                                        <i class="fas fa-check"></i> Accept
                                    </button>
                                </form>
                                <form action="{{ route('roommate.application.reject', $application->app_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn2 btn-danger btn-action reject-btn" data-id="{{ $application->app_id }}">
                                        <i class="fas fa-times"></i> Reject
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">No actions available</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">No applications have been submitted to your requests yet.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('.accept-btn').on('click', function(e) {
                e.preventDefault();
                const form = $(this).closest('form');
                const appId = $(this).data('id');
                if (confirm('Are you sure you want to accept application #' + appId + '?')) {
                    form.submit();
                }
            });

            $('.reject-btn').on('click', function(e) {
                e.preventDefault();
                const form = $(this).closest('form');
                const appId = $(this).data('id');
                if (confirm('Are you sure you want to reject application #' + appId + '?')) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
