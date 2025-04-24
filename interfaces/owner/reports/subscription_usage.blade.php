@extends('website.layouts.app_owner')

@section('title', 'Subscription Usage Report')

@section('content')
    <div class="container dashboard-content">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-dark">
                <h5 class="mb-0">Subscription Usage Report</h5>
                <p class="text-muted">This report shows the status of your subscription, including how many ads you've used and how many remain available within your current plan.</p>

            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <p></p>
                    <a href="{{ route('owner.reports.index') }}" class="btn btn2 btn-danger">
                        <i class="fas fa-arrow-right"></i> Back
                    </a>
                </div>
                @if($subscription)
                    <div class="row mb-3">
                        <div class="col-md-12 mb-3 border-dark">
                            <strong>Subscription Start:</strong> {{ $subscription->sub_start_date->format('Y-m-d') }}
                        </div>
                        <div class="col-md-12 mb-3 border-dark">
                            <strong>Subscription End:</strong> {{ $subscription->sub_end_date->format('Y-m-d') }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 mb-3 border-dark">
                            <strong>Total Ads Allowed:</strong> {{ $subscription->sub_number_of_ads + $totalAdsPosted }}
                        </div>
                        <div class="col-md-12 mb-3 border-dark">
                            <strong>Ads Posted:</strong> {{ $totalAdsPosted }}
                        </div>
                        <div class="col-md-12 mb-3 border-dark">
                            <strong>Remaining Ads:</strong> {{ $subscription->sub_number_of_ads }}
                        </div>
                    </div>
                @else
                    <div class="alert alert-info">
                        You are currently on the <strong>free plan</strong>. You can post up to <strong>10 ads</strong>. <br>
                        <a href="{{ route('owner.subscription') }}" class="btn btn-sm btn-primary mt-2">Upgrade Now</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
