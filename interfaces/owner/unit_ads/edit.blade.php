@extends('website.layouts.app_owner')

@section('title', 'Edit Unit Ad')

@section('content')
    <div class="container dashboard-content">
        @include('website.owner.unit_ads.form', ['action' => route('owner.unit_ads.update',  $unitAd->ua_id), 'method' => 'PUT'])
    </div>
@endsection
