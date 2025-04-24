@extends('website.layouts.app')

@section('title', 'Nafath Login')

@section('content')
    <div class="hero page-inner overlay d-flex align-items-center" style="background-image: url('{{ asset('assets/images/hero_bg_1.jpg') }}'); min-height: 250px;">
        <div class="container text-center text-white">
            <h1 class="display-5 text-white fw-bold">الدخول عبر نفاذ</h1>
        </div>
    </div>

    <div class="container py-5" dir="rtl">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="text-center mb-4">
                    <h5 style="color: #11998e" class="fw-bold">الدخول على النظام</h5>
                    <div style="    background-color: #11998e;
    color: white;" class=" text-white p-2 rounded">تطبيق نفاذ</div>
                </div>

                <div class="bg-white shadow-sm p-4 rounded" style="border: 1px solid #ddd;">
                    @if(session('error'))
                        <div class="alert alert-danger text-center">{{ session('error') }}</div>
                    @endif

                    <form method="POST" action="{{ route('website.nafath.submit') }}">
                        @csrf
                        <div class="row align-items-center">

                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">رقم بطاقة الدخول/الإقامة</label>
                                    <input type="number" name="acc_national_id" class="form-control text-end" placeholder="أدخل رقم الدخول الخاص بك هنا" required>
                                </div>
                                <button style="background-color: #11998e !important;" type="submit" class="btn btn-success w-100">تسجيل الدخول</button>
                            </div>
                            <div class="col-md-4 text-center mb-3 mb-md-0">
                                <img src="https://www.iam.gov.sa/img/secure.svg" alt="Key Icon" style="width: 150px;">
                            </div>
                        </div>
                    </form>

                    <div class="mt-4 text-center text-muted small">
                        الرجاء إدخال رقم بطاقة الدخول/الإقامة ثم اضغط دخول
                    </div>

                    <div class="mt-3 text-center">
                        <p class="mb-1 fw-bold">لتحميل تطبيق نفاذ</p>
                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                            <img src="https://www.iam.gov.sa/img/huawei_store.jpg" height="40" alt="AppGallery">
                            <img src="https://www.iam.gov.sa/img/google_play.png" height="40" alt="Google Play">
                            <img src="https://www.iam.gov.sa/img/apple_store.png" height="40" alt="App Store">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
