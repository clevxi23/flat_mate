@extends('website.layouts.app_owner')

@section('title', 'Subscribe to Premium')

@push('css')
    <style>
        .subscription-container {
            /*max-width: 700px;*/
            /*margin: 50px auto;*/
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }
        .package-details {
            border: 2px solid #d59c6c;
            padding: 20px;
            border-radius: 10px;
            background: #f8f9fa;
            margin-bottom: 25px;
        }
        .payment-form {
            background: #f1f3f5;
            padding: 20px;
            border-radius: 10px;
        }
        .form-label {
            font-weight: 600;
            color: #333;
        }
        .payment-image {
            max-width: 100%;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .btn-primary {
            background: #007bff;
            border: none;
            padding: 12px 30px;
            font-size: 1.1rem;
            transition: background 0.3s ease;
        }
        .btn-primary:hover {
            background: #0056b3;
        }
    </style>
@endpush

@section('content')
    <div class="container dashboard-content py-4">
        <div class="subscription-container">
            <h3 class="text-primary text-center mb-4"><i class="fas fa-box"></i> Upgrade to Premium</h3>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->has('payment'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $errors->first('payment') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

           <div class="row">
               <div class="col-md-6">
                   <select class="form-select" onchange="window.location.href='{{ route('owner.subscribe') }}?package=' + this.value;">
                       @foreach($packages as $pkg)
                           <option value="{{ $pkg->pack_id }}" {{ $pkg->pack_id == $package->pack_id ? 'selected' : '' }}>
                               {{ $pkg->pack_name }} - {{ number_format($pkg->pack_fee, 2) }} SAR
                           </option>
                       @endforeach
                   </select>

                   <div class="package-details">
                       <h5 class="text-primary">{{ $package->pack_name }}</h5>
                       <p><strong>Fee:</strong> {{ $package->pack_fee }} SAR</p>
                       <p><strong>Duration:</strong> {{ $package->pack_duration }} Months</p>
                       <p><strong>Privileges:</strong> {{ $package->pack_privillages }}</p>
                       <p>.</p>
                       <p>.</p>
                   </div>
               </div>
               <div class="col-md-6">
                   <div class="package-details">
                   <div class="text-center">
                       <img src="{{asset('payment.webp')}}" alt="Secure Payment" class="payment-image">
                   </div>
                   </div>
               </div>
           </div>

            <div class="payment-form">
                <h5 class="text-primary mb-3"><i class="fas fa-credit-card"></i> Payment Details</h5>
                <form action="{{ route('owner.subscribe.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Card Number <strong class="text-danger">*</strong></label>
                        <input type="text" class="form-control @error('card_number') is-invalid @enderror" name="card_number" value="{{ old('card_number') }}" maxlength="16" placeholder="1234 5678 9012 3456" required>
                        @error('card_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Cardholder Name <strong class="text-danger">*</strong></label>
                        <input type="text" class="form-control @error('cardholder_name') is-invalid @enderror" name="cardholder_name" value="{{ old('cardholder_name') }}" placeholder="John Doe" required>
                        @error('cardholder_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Expiry Date <strong class="text-danger">*</strong></label>
                            <input type="text" class="form-control @error('expiry_date') is-invalid @enderror" name="expiry_date" value="{{ old('expiry_date') }}" placeholder="MM/YY" required>
                            @error('expiry_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">CVV <strong class="text-danger">*</strong></label>
                            <input type="text" class="form-control @error('cvv') is-invalid @enderror" name="cvv" value="{{ old('cvv') }}" maxlength="3" placeholder="123" required>
                            @error('cvv')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-lock"></i> Pay {{ $package->pack_fee }} SAR</button>
                </form>
            </div>

            <a href="{{ route('owner.dashboard') }}" class="btn btn-outline-secondary w-100 mt-3"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Optional: Add input masking for card number and expiry date (e.g., using a library like Inputmask)
            const cardNumber = document.querySelector('input[name="card_number"]');
            cardNumber.addEventListener('input', function () {
                this.value = this.value.replace(/\D/g, ''); // Allow only digits
            });

            const cvv = document.querySelector('input[name="cvv"]');
            cvv.addEventListener('input', function () {
                this.value = this.value.replace(/\D/g, ''); // Allow only digits
            });

            const expiryDate = document.querySelector('input[name="expiry_date"]');
            expiryDate.addEventListener('input', function () {
                this.value = this.value.replace(/[^0-9/]/g, ''); // Allow digits and /
                if (this.value.length === 2 && !this.value.includes('/')) {
                    this.value += '/';
                }
            });
        });
    </script>
@endpush
