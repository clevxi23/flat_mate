@extends('website.layouts.app_owner')

@section('title', 'Add New Unit Ad')

@section('content')
    <div class="container dashboard-content">
        @include('website.owner.unit_ads.form', [
            'action' => route('owner.unit_ads.store'),
            'method' => 'POST',
            'unitAd' => null
        ])
    </div>
@endsection
