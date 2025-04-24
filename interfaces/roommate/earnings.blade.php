@extends('website.layouts.app')

@section('title', 'My Points')

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
        .profile-container {
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            margin-bottom: 30px;
        }
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
                    <h1 class="heading text-white" data-aos="fade-up">My Points</h1>
                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">My Points</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Points Summary -->
    <div class="container dashboard-content mt-5 mb-4">
{{--        <div class="profile-container text-center">--}}
{{--            <h3 class="text-success"><i class="fas fa-coins"></i> Congratulations!</h3>--}}
{{--            <p>You have earned <strong class="text-warning">{{ $totalPoints }} points</strong> from <strong class="text-primary">{{ $reviews->count() }} reviews</strong>.</p>--}}
{{--        </div>--}}

        <!-- Points Breakdown -->
        <div class="mt-4">
            <h4 class="text-dark text-center mt-4 mb-4">Points Earned from Reviews</h4>
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <table id="dataTable" class="table table-bordered mt-3">
                <thead class="table">
                <tr>
                    <th>#</th>
                    <th>Location</th>
                    <th>Comment</th>
                    <th>Rate</th>
                    <th>Date</th>
                    <th>Points Earned</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($reviews as $index=>$review)
                    <tr>
                        <td>{{$index + 1}}</td>
                        <td>{{ $review->unitAds->ua_address }}</td>
                        <td>{{ $review->review_comment }}</td>
                        <td>{{ $review->review_rate }} stars </td>
                        <td>{{ \Carbon\Carbon::create($review->review_date)->format('F j, Y') }}</td>
                        <td>5 Points</td>
                        <td>
                            <form action="{{ route('roommate.review.delete', $review->review_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete delete-btn" data-id="{{ $review->review_id }}">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">You have not submitted any reviews yet.</td>
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
            $('.delete-btn').on('click', function(e) {
                e.preventDefault();
                const form = $(this).closest('form');
                const reviewId = $(this).data('id');
                if (confirm('Are you sure you want to delete review #' + reviewId + '? This will deduct 5 points from your total.')) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
