@extends('website.layouts.app')
@section('title', '{{ $unitAd->ua_address ?? "Unit Ad Details" }}')
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <style>
        .owner-box {
            padding: 20px;
            border-radius: 8px;
            background: #f8f9fa;
        }
        .gallery-thumbs {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }
        .gallery-thumbs img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
            cursor: pointer;
            transition: opacity 0.3s;
        }
        .gallery-thumbs img:hover {
            opacity: 0.8;
        }
    </style>
@endpush
@section('content')
    <!-- Hero Section -->
    <div class="hero page-inner overlay d-flex align-items-center" style="background-image: url('{{ $unitAd->images->first() ? asset($unitAd->images->first()->image_url) : asset('assets/images/hero_bg_1.jpg') }}'); min-height: 400px;">
        <div class="container text-center text-white">
            <h1 class="display-4 text-white fw-bold">{{ $unitAd->ua_address ?? 'Unit Ad Details' }}</h1>
            <p class="lead">Experience modern living with unmatched elegance and convenience.</p>
        </div>
    </div>

    <div class="section py-5">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <!-- Unit Ad Gallery & Description -->
                <div class="col-lg-8">
                    <div class="unit-ad-gallery mb-4">
                        <a href="{{ $unitAd->images->first() ? asset($unitAd->images->first()->image_url) : asset('img/about.png') }}" data-lightbox="gallery" data-title="{{ $unitAd->ua_address }}">
                            <img width="100%" src="{{ $unitAd->images->first() ? asset($unitAd->images->first()->image_url) : asset('img/about.png') }}" alt="Unit Ad Image" class="img-fluid shadow">
                        </a>
                        @if($unitAd->images->count() > 1)
                            <div class="gallery-thumbs">
                                @foreach($unitAd->images->skip(1) as $image)
                                    <a href="{{ asset($image->image_url) }}" data-lightbox="gallery" data-title="{{ $unitAd->ua_address }}">
                                        <img src="{{ asset($image->image_url) }}" alt="Thumbnail">
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <p class="des">
                        {{ $unitAd->ua_description ?? 'No description available.' }}
                    </p>

                    <ul class="list-unstyled">
                        <li class="licustom"><i class="fas fa-ruler-combined text-primary"></i> <strong>Size:</strong> {{ $unitAd->ua_size }} sqm</li>
                        <li class="licustom"><i class="fas fa-users text-primary"></i> <strong>Roommates:</strong> {{ $unitAd->ua_num_of_roommates ?? 'Not specified' }} persons</li>
                        <li class="licustom"><i class="fas fa-calendar-alt text-primary"></i> <strong>Lease Term:</strong> {{ $unitAd->ua_lease_term ?? 'Not specified' }} months</li>
                        <li class="licustom"><i class="fas fa-smoking-ban text-primary"></i> <strong>Smoking Allowed:</strong> {{ $unitAd->ua_smoking_allowed ? 'Yes' : 'No' }}</li>
                        <li class="licustom"><i class="fas fa-paw text-primary"></i> <strong>Pets Allowed:</strong> {{ $unitAd->ua_pets_allowed ? 'Yes' : 'No' }}</li>
                        <li class="licustom"><i class="fas fa-dumbbell text-primary"></i> <strong>Facilities:</strong> {{ $unitAd->facilities->pluck('fac_title')->implode(', ') ?: 'None' }}</li>
                    </ul>

                </div>

                <!-- Owner + Unit Ad Info Box -->
                <div class="col-lg-4">
                    <div class="owner-box shadow-sm">
                        <div class="position-relative">
                            <i class="fas fa-user-circle user-icon"></i>
                        </div>
                        <h5 class="fw-bold mt-3">{{ $unitAd->account->acc_name ?? 'Anonymous Owner' }}</h5>
                        <p class="text-muted">Real Estate Owner</p>
                        <p class="text-muted">"Helping people find their dream homes with ease and trust."</p>

                        <h4 class="fw-bold text-primary mt-3">{{ $unitAd->ua_address ?? 'Unit Ad' }}</h4>
                        <p><i class="fas fa-map-marker-alt text-danger"></i> {{ $unitAd->ua_address }}</p>
                        <h3 class="text-success fw-bold">{{ number_format($unitAd->ua_rent_fees) }} <img style="height: 20px;width: 20px;border-radius: 0;" src="{{asset('sar.png')}}"> / Month</h3>

                        @auth
                            <button class="btn btn-primary w-100 mt-3" id="open-chat">
                                <i class="fas fa-comment-alt"></i> Chat with Owner
                            </button>
                            @if($unitAd->ua_status == 'Available')
                                <a href="{{ route('roommate.request.create', $unitAd->ua_id) }}" class="btn btn-primary  w-100 mt-3">
                                    <i class="fas fa-user-plus"></i> Add Roommate Request
                                </a>
                            @elseif($unitAd->ua_status != 'Available')
                                <p class="text-muted mt-3">This unit is {{ $unitAd->ua_status }} and no longer accepting roommate requests.</p>
                            @endif
{{--                            <a href="{{ route('roommate.request.create', $unitAd->ua_id) }}" class="btn btn-primary  w-100 mt-3">--}}
{{--                                <i class="fas fa-user-plus"></i> Add Roommate Request--}}
{{--                            </a>--}}
                        @else
                           <p class="text-danger mt-5">
                              please <a href="{{ route('website.login') }}" class="text-decoration-underline">Login</a> to be able to make roommate request or chat with owner
                           </p>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="reviews-container mt-5">
                <div class="col-md-8 review-list">
                    <h3 class="mb-4 text-dark"><i class="fas fa-star text-warning"></i> Reviews ({{ $unitAd->reviews->count() }})</h3>
                    @forelse($unitAd->reviews as $review)
                        <div class="review-item mb-4 p-3 border rounded shadow-sm bg-white">
                            <h5>{{ $review->account->acc_name ?? 'Anonymous' }}</h5>
                            <small class="text-muted">{{ date('Y-m-d H:i A', strtotime($review->review_dateTime)) }}</small>
                            <div class="rating mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $review->review_rate ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                            </div>
                            <p>{{ $review->review_comment }}</p>
                        </div>
                    @empty
                        <p class="text-muted">No reviews yet.</p>
                    @endforelse
                </div>

                <div class="col-md-4 add-review-box">
                    <h4 class="text-dark">Leave a Review</h4>
                    @auth
                        <form action="{{ route('website.unit_ad_single.store_review', $unitAd->ua_id) }}" method="POST">
                            @csrf
                            <textarea class="form-control mb-3 @error('comment') is-invalid @enderror" rows="3" name="comment" placeholder="Write your review..." required></textarea>
                            @error('comment')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <label class="form-label">Rating</label>
                            <div class="rating-stars">
                                <i class="fas fa-star" data-value="1"></i>
                                <i class="fas fa-star" data-value="2"></i>
                                <i class="fas fa-star" data-value="3"></i>
                                <i class="fas fa-star" data-value="4"></i>
                                <i class="fas fa-star" data-value="5"></i>
                                <input class="d-none" type="text" name="rating" id="rating-value" required>
                            </div>
                            @error('rating')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror

                            <button type="submit" class="btn btn-primary w-100 mt-3">Submit Review</button>
                        </form>
                    @else
                        <p class="text-danger">Please <a href="{{ route('website.login') }}">login</a> to leave a review.</p>
                    @endauth
                </div>
            </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script>
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
                url: '{{ route('website.unit_ad_single.send_message', $unitAd->acc_id) }}',
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

        document.querySelectorAll('.rating-stars i').forEach(star => {
            star.addEventListener('click', function() {
                let value = this.getAttribute('data-value');
                document.getElementById('rating-value').value = value;

                document.querySelectorAll('.rating-stars i').forEach(s => {
                    s.classList.remove('text-warning');
                });

                for (let i = 0; i < value; i++) {
                    document.querySelectorAll('.rating-stars i')[i].classList.add('text-warning');
                }
            });
        });
    </script>
@endpush
