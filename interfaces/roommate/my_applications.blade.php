@extends('website.layouts.app')

@section('title', 'My Applications')

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
        .btn-delete {
            background: #dc3545;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            transition: background 0.3s ease;
        }
        .btn-delete:hover {
            background: #c82333;
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <div class="hero page-inner overlay" style="background-image: url('{{ asset('assets/images/hero_bg_3.jpg') }}')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading text-white" data-aos="fade-up">My Applications</h1>
                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">My Applications</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container dashboard-content">
        <h2 class="mb-4 text-center" style="font-weight: 600;">My Submitted Applications</h2>
        <div class="applications-table">
            <table id="dataTable" class="table table-bordered table-hover text-center">
                <thead>
                <tr>
                    <th>Application ID</th>
                    <th>Location</th>
                    <th>Request ID</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($applications as $application)
                    <tr>
                        <td>{{ $application->app_id }}</td>
                        <td>{{ $application->roommateRequest->unitAd->ua_address }}</td>
                        <td>{{ $application->roommateRequest->roommate_req_id }}</td>
                        <td>
                                <span class="status-badge status-{{ strtolower($application->app_status) }}">
                                    {{ $application->app_status }}
                                </span>
                        </td>
                        <td>

                            <a href="{{ route('chat.show', optional($application->roommateRequest)->acc_id) }}" class="btn btn2 btn-details">
                                <i class="fas fa-comment-alt"></i> Chat
                            </a>
                            <a href="{{ route('roommate.request.show', $application->roommateRequest->roommate_req_id) }}" class="btn btn2 btn-details">
                                <i class="fas fa-eye"></i> Details
                            </a>
                            @if($application->app_status == 'pending')
                                <form action="{{ route('roommate.application.delete', $application->app_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete delete-btn" data-id="{{ $application->app_id }}">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">Cannot delete</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">You have not submitted any applications yet.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.delete-btn').on('click', function(e) {
                e.preventDefault();
                const form = $(this).closest('form');
                const appId = $(this).data('id');
                if (confirm('Are you sure you want to delete application #' + appId + '?')) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
