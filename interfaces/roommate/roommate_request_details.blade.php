@extends('website.layouts.app')

@section('title', 'Roommate Request Details')

@push('css')
    <style>
        .details-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 30px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }
        .join-btn {
            background: linear-gradient(to right, #f5b29a, #e7784a);
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 1rem;
            border: none;
            transition: background 0.3s ease;
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
                    <h1 class="heading text-white" data-aos="fade-up">Roommate Request Details</h1>
                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('website.find_roommates') }}">Requests</a></li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Request Details -->
    <div class="container mt-5 mb-5">
        <div class="details-container">
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
                @if($request->req_status != 'Open' || $request->unitAd->ua_status != 'Available')
                    <div class="alert alert-warning" role="alert">
                        This request is {{ $request->req_status }} or the unit is {{ $request->unitAd->ua_status }}. No further applications are accepted.
                    </div>
                @endif

            <!-- Unit Details -->
            <div class="unit-details">
                <h5>{{ $request->unitAd->ua_title }}</h5>
                <p><i class="fas fa-map-marker-alt"></i> <strong>Location:</strong> {{ $request->unitAd->ua_address }}</p>
                <p><i class="fas fa-money-bill-wave"></i> <strong>Rent:</strong> {{  number_format($request->unitAd->ua_rent_fees) }} SAR / Month</p>
                <p><i class="fas fa-ruler-combined"></i> <strong>Size:</strong> {{ $request->unitAd->ua_size }} sqm</p>
                <p><i class="fas fa-users"></i> <strong>Max Roommates:</strong> {{ $request->unitAd->ua_num_of_roommates }}</p>
                <p><i class="fas fa-smoking-ban"></i> <strong>Smoking:</strong> {{ $request->unitAd->ua_smoking_allowed ? 'Yes' : 'No' }}</p>
                <p><i class="fas fa-paw"></i> <strong>Pets:</strong> {{ $request->unitAd->ua_pets_allowed ? 'Yes' : 'No' }}</p>
                <p><i class="fas fa-dumbbell"></i> <strong>Facilities:</strong> {{ $request->unitAd->facilities->pluck('fac_title')->implode(', ') ?: 'None' }}</p>
            </div>

            <!-- Request Details -->
            <div class="request-details">
                <h5>Roommate Preferences</h5>
                <p><i class="fas fa-user"></i> <strong>Posted by:</strong> {{ $request->account->acc_name }}</p>
                <p><i class="fas fa-info-circle"></i> <strong>Description:</strong> {{ $request->roommate_req_des }}</p>
                <p><i class="fas fa-venus-mars"></i> <strong>Gender:</strong> {{ $request->roommate_req_gender }}</p>
                <p><i class="fas fa-calendar-alt"></i> <strong>Age Range:</strong> {{ $request->roommate_req_age }}</p>
                <p><i class="fas fa-briefcase"></i> <strong>Employment:</strong> {{ $request->roommate_req_emp_status }}</p>
                <p><i class="fas fa-smoking"></i> <strong>Smoking:</strong> {{ $request->roommate_req_smoking ? 'Yes' : 'No' }}</p>
                <p><i class="fas fa-child"></i> <strong>Children:</strong> {{ $request->roommate_req_child }}</p>
                <p><i class="fas fa-paw"></i> <strong>Pets:</strong> {{ $request->roommate_req_pets_ref ? 'Yes' : 'No' }}</p>
                <p><i class="fas fa-users"></i> <strong>Number of Roommates:</strong> {{ $request->roommate_req_num_of_roommate }}</p>
            </div>
                @auth
                    @if(Auth::id() != $request->acc_id && $request->req_status == 'Open' && $request->unitAd->ua_status == 'Available')
                        <div class="d-flex">
                            <button style="margin-right: 10px;" class="btn rounded-0 btn-primary w-100 mt-3 join-request-btn"
                                    data-request-id="{{ $request->roommate_req_id }}"><i class="fas fa-user-plus"></i>
                                Join This Request
                            </button>
                            <button style="margin-right: 10px;" class="btn rounded-0 btn-primary w-100 mt-3" id="open-chat"><i
                                    class="fas fa-comment-alt"></i> Chat with Roommate
                            </button>
                            <a href="#" class="btn rounded-0 btn-primary w-100 mt-3" id="open-chat"><i
                                    class="fas fa-eye"></i> View Unit</a>
                        </div>
                    @endif
                @else
                    <p class="text-danger text-center">please <a href="{{route('website.login')}}">log in</a> to be able to join with roommate</p>
                @endauth
        </div>
    </div>

    <!-- Floating Chat Box -->
    @auth
        <div id="chat-box" class="chat-box shadow-lg">
            <div class="chat-header bg-primary text-white d-flex justify-content-between p-3">
                <span class="text-dark"><i class="fas fa-comments"></i> Chat with {{ $unitAd->account->acc_name ?? 'Owner' }}</span>
                <button id="close-chat" class="btn-sm btn-danger"><i class="fa fa-times-circle"></i></button>
            </div>
            <div class="chat-body" id="chat-body">
                @forelse($messages as $message)
                    <div class="message {{ $message->sender_id == Auth::id() ? 'sent' : 'received' }}">
                        <small>{{ $message->sender->acc_name }} ({{ date('Y-m-d H:i A', strtotime($message->ma_date_time)) }})</small>
                        <p>{{ $message->ma_content }}</p>
                    </div>
                @empty
                    <p class="text-muted text-center">No messages yet.</p>
                @endforelse
            </div>
            <div class="chat-footer p-2 d-flex">
                <input type="text" class="form-control me-2" id="chat-message" placeholder="Type your message..." required>
                <button style="    padding: 10px;" id="send-message" class="btn btn-primary"><i class="fas fa-paper-plane"></i></button>
            </div>
        </div>
    @endauth
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

        @auth
        document.getElementById('open-chat').addEventListener('click', function() {
            const chatBox = document.getElementById('chat-box');
            chatBox.style.display = 'block';
            chatBox.querySelector('.chat-body').scrollTop = chatBox.querySelector('.chat-body').scrollHeight;
        });
        document.getElementById('close-chat').addEventListener('click', () => document.getElementById('chat-box').style.display = 'none');

        $('#send-message').on('click', function(e) {
            e.preventDefault();
            const message = $('#chat-message').val().trim();
            if (!message) return;

            $.ajax({
                url: '{{ route('website.unit_ad_single.send_message', $request->acc_id) }}',
                method: 'POST',
                data: {
                    message: message,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        const chatBody = $('#chat-body');
                        const newMessage = `
                            <div class="message sent">
                                <small>${response.message.sender} (${response.message.date_time})</small>
                                <p>${response.message.content}</p>
                            </div>
                        `;
                        chatBody.append(newMessage);
                        $('#chat-message').val('');
                        chatBody.scrollTop(chatBody[0].scrollHeight);
                    }
                },
                error: function(xhr) {
                    alert('Error sending message: ' + xhr.responseJSON.message);
                }
            });
        });
        $('#chat-message').on('keypress', function(e) {
            if (e.which === 13) {
                $('#send-message').click();
            }
        });
        @endauth
    </script>
@endpush
