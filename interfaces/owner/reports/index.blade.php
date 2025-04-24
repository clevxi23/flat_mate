@extends('website.layouts.app_owner')

@section('title', 'Reports')

@section('content')
    <div class="container dashboard-content">
        <div class="row mt-5">
            <div class="col-md-4 mb-4">
                <a href="{{ route('owner.reports.unit_ads') }}" class="text-decoration-none">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-building fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">My Unit Ads Report</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4">
                <a href="{{ route('owner.reports.roommate_requests') }}" class="text-decoration-none">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-users fa-3x text-success mb-3"></i>
                            <h5 class="card-title">Roommate Requests Report</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4">
                <a href="{{ route('owner.reports.subscription_usage') }}" class="text-decoration-none">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <i class="fas fa-credit-card fa-3x text-warning mb-3"></i>
                            <h5 class="card-title">Subscription Usage Report</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
