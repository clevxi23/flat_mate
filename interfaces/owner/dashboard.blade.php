
@extends('website.layouts.app_owner')

@section('title', 'House Owner Dashboard')

@push('css')
    <style>
        .chart-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 30px;
        }
    </style>
@endpush

@section('content')
    <div class="container dashboard-content">
        <!-- Welcome Alert -->
        <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center justify-content-between" role="alert">
            <div>
                <i class="fas fa-exclamation-circle me-2"></i>
                @if(!$subscription || $subscription->sub_end_date < now())
                    Upgrade to a premium package to unlock more features, post unlimited ads, and reach potential renters faster.
                @else
                    <strong>Welcome, {{ $account->acc_name }}!</strong> Your Premium Plan allows you to post up to {{ $subscription->sub_number_of_ads }} ads. This {{ $subscription->package->pack_duration }} months subscription expires on {{ $subscription->sub_end_date->format('d M Y') }}.
                @endif
            </div>
            @if(!$subscription || $subscription->sub_end_date < now())
                <a href="{{ route('owner.subscribe') }}" class="btn btn2 btn-sm btn-primary">Upgrade Now</a>
            @else
                <span class="badge bg-success">Premium Active</span>
            @endif
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        </div>
        <!-- Stats Section -->
        <div class="stats-container">


            <div class="stat-box">
                <i class="fas fa-3x fa-ad"></i>
                <h3> {{ $remainingAds }}</h3>
                <p>The Remaining Units Ads Allowed</p>
            </div>
            <div class="stat-box">
                <i class="fas fa-3x fa-heart"></i>
                <h3>{{ $totalLikes }}</h3>
                <p>Total Likes</p>
            </div>
            <div class="stat-box">
                <i class="fas fa-3x fa-eye"></i>
                <h3>{{ $totalViews }}</h3>
                <p>Total Views</p>
            </div>
            <div class="stat-box">
                <i class="fas fa-3x fa-building"></i>
                <h3>{{ $totalUnitAds }}</h3>
                <p>Total Unit Ads</p>
                <small>Active: {{ $availableUnitAds }} | Booked: {{ $bookedUnitAds }}</small>
            </div>
            <div class="stat-box">
                <i class="fas fa-3x fa-envelope"></i>
                <h3>{{ $unreadMessagesCount }}</h3>
                <p>Unread Messages</p>
            </div>
            <div class="stat-box">
                <i class="fas fa-3x fa-star"></i>
                <h3>{{ $totalReviews }}</h3>
                <p>Total Reviews</p>
            </div>
            <div class="stat-box">
                <i class="fas fa-3x fa-users"></i>
                <h3>{{ $account->applications()->count() }}</h3>
                <p>Total Roommate Requests</p>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row">
            <!-- Monthly Revenue Line Chart -->
            <div class="col-md-8">
                <div class="chart-container">
                    <h4 class="text-center text-primary">Monthly Revenue Overview</h4>
                    <div id="revenueChart"></div>
                </div>
            </div>
            <!-- Unit Ads Status Pie Chart -->
            <div class="col-md-4">
                <div class="chart-container">
                    <h4 class="text-center text-primary">Unit Ads Status</h4>
                    <div id="statusChart"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Monthly Revenue Line Chart
            var revenueOptions = {
                series: [{
                    name: 'Revenue (SAR)',
                    data: @json(array_values($monthlyRevenue))
                }],
                chart: {
                    type: 'line',
                    height: 350,
                    toolbar: {
                        show: true
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    categories: @json(array_keys($monthlyRevenue)),
                    title: {
                        text: 'Months'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Revenue (SAR)'
                    }
                },
                colors: ['#007bff'],
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val + " SAR";
                        }
                    }
                }
            };
            var revenueChart = new ApexCharts(document.querySelector("#revenueChart"), revenueOptions);
            revenueChart.render();

            // Unit Ads Status Pie Chart
            var statusOptions = {
                series: [@json($availableUnitAds), @json($bookedUnitAds), @json($closedUnitAds)],
                chart: {
                    type: 'pie',
                    height: 350
                },
                labels: ['Available', 'Booked', 'Closed'],
                colors: ['#97d167', '#ca7076', '#d11c1c'],
                legend: {
                    position: 'bottom'
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 300
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };
            var statusChart = new ApexCharts(document.querySelector("#statusChart"), statusOptions);
            statusChart.render();
        });
    </script>
@endpush
