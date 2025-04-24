@extends('website.layouts.app')

@section('title', 'Nafath Login Confirmation')

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
                    <div style="background-color: #11998e; color: white;" class="text-white p-2 rounded">تطبيق نفاذ</div>
                </div>

                <div class="bg-white shadow-sm p-5 rounded text-center" style="border: 1px solid #ddd;">
                    <img src="https://www.iam.gov.sa/img/secure.svg" alt="Secure Icon" style="width: 80px;" class="mb-4">

                    <div class="bg-light p-3 rounded d-inline-block mb-3" style="font-size: 24px; font-weight: bold;">
                        {{ $code ?? '53' }}
                    </div>

                    <p class="mb-4">الرجاء فتح تطبيق نفاذ وتأكيد الطلب باستخدام الرقم أعلاه</p>

                    <a href="{{ route('website.login') }}" class="btn btn-outline-secondary">
                        إلغاء
                    </a>
                </div>

                <div class="mt-5 text-center">
                    <div style="background-color: #11998e; color: white;"  class="b text-white p-3 rounded">
                        <strong>منصة النفاذ الجديدة</strong><br>
                        تجربة أكثر سلاسة للمستخدم باستخدام النسخة الجديدة من منصة النفاذ الوطني الموحد.
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
