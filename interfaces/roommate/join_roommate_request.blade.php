@extends('website.layouts.app')

@section('title', 'Join a Roommate Request')

@push('css')
    <style>
        .request-card {
            background: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s;
            border: 2px solid #f0f0f0;
            position: relative;
        }

        .request-card:hover {
            transform: scale(1.03);
            box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.15);
        }

        .request-card h5 {
            color: #6a6d6f;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .request-card p {
            margin-bottom: 5px;
            color: #555;
        }

        .request-card .status {
            font-weight: bold;
            color: #4cea6f;
        }

        .request-icon {
            font-size: 50px;
            color: #f5b29a;
            margin-bottom: 10px;
        }

        .request-actions {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        .join-btn {
            background: linear-gradient(to right, #f5b29a, #e7784a);
            color: white;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 14px;
            transition: 0.3s ease-in-out;
            border: none;
        }

        .join-btn:hover {
            background: #e7784a;
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <div class="hero page-inner overlay" style="background-image: url('{{ asset('assets/images/hero_bg_1.jpg') }}')">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading text-white" data-aos="fade-up">Join a Roommate Request</h1>
                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">Roommate Requests</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Roommate Requests -->
    <div class="section py-5">
        <div class="container request-container">
            <div class="row">
                @forelse($requests as $request)
                    <div class="col-md-4 mb-4">
                        <div class="request-card">
                            <i class="fas fa-home request-icon"></i>
                            <h6><i class="fas fa-map-marker-alt text-danger"></i> {{ $request->unitAd->ua_address }}</h6>
                            <p><strong>Unit Owner :</strong> {{ optional($request->unitAd)->account->acc_name }}</p>
                            <p><strong>Posted by:</strong> {{ optional($request->account)->acc_name }}</p>
                            <p><strong>Gender Preference:</strong> {{ $request->roommate_req_gender }}</p>
                            <p class="status"><strong>Looking for:</strong> {{ $request->roommate_req_num_of_roommate }} Roommate(s)</strong></p>
                            <div class="request-actions">
                                <a href="{{ route('roommate.request.show', $request->roommate_req_id) }}" class="btn btn-outline-secondary btn2">
                                    <i class="fas fa-eye"></i> View Details
                                </a>
                                @if(Auth::id() != $request->acc_id)
                                    <button class="btn join-btn join-request-btn" data-request-id="{{ $request->roommate_req_id }}">
                                        <i class="fas fa-user-plus"></i> Apply
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No roommate requests available yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('.join-request-btn').on('click', function() {
                const requestId = $(this).data('request-id');
                if (confirm('Are you sure you want to join this roommate request?')) {
                    $.ajax({
                        url: '{{ url("/roommates/requests") }}/' + requestId + '/join',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            alert(response.success || 'Application submitted successfully!');
                            location.reload();
                        },
                        error: function(xhr) {
                            alert(xhr.responseJSON.error || 'An error occurred while submitting your application.');
                        }
                    });
                }
            });
        });
    </script>
@endpush
