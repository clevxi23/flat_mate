@extends('website.layouts.app_admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container dashboard-content">

        <div class="alert alert-info d-flex align-items-center justify-content-between" role="alert">
            <div>
                <i class="fas fa-info-circle me-2"></i>
                <strong>System Overview:</strong> Stay updated on the platform’s performance and activities.
            </div>
            <a href="{{ route('admin.reports') }}" class=" btn-sm btn-primary">View Reports</a>
        </div>

        <!-- Stats Section -->
        <div class="stats-container">
            <div class="stat-box">
                <i class="fas fa-3x fa-users"></i>
                <h3>{{ $totalUsers }}</h3>
                <p>Total Accounts</p>
            </div>

            <div class="stat-box">
                <i class="fas fa-3x fa-home"></i>
                <h3>{{ $totalListings }}</h3>
                <p>Total Unit Ads</p>
            </div>
            <div class="stat-box">
                <i class="fas fa-3x fa-box"></i>
                <h3>{{ $totalPackages }}</h3>
                <p>Total Packages</p>
            </div>
            <div class="stat-box">
                <i class="fas fa-3x fa-comments"></i>
                <h3>{{ $mes }}</h3>
                <p>Total Messages</p>
            </div>
            <div class="stat-box">
                <i class="fas fa-3x fa-heart"></i>
                <h3>{{ $totalLikes }}</h3>
                <p>Total Likes</p>
            </div>
            <div class="stat-box">
                <i class="fas fa-3x fa-eye"></i>
                <h3>{{ $totalLikes }}</h3>
                <p>Total Views</p>
            </div>
            <div class="stat-box">
                <i class="fas fa-3x fa-flag"></i>
                <h3>{{ $totalReports }}</h3>
                <p>Total Request</p>
            </div>

            <div class="stat-box">
                <i class="fas fa-3x fa-star"></i>
                <h3>{{ $totalR }}</h3>
                <p>Total Reviews</p>
            </div>
        </div>

        <!-- Chart Section -->
<div class="row">
    <div class="col-md-6">
        <div class="chart-container mt-5">
            <h4 class="text-center">Monthly Unit Ads</h4>
            <div id="userChart"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="chart-container mt-5">
            <h4 class="text-center">Subscriptions per Package</h4>
            <div id="packageChart"></div>
        </div>
    </div>
</div>


        {{--        <!-- Recent Requests -->--}}
{{--        <div class="table-responsive mt-4">--}}
{{--            <h4>Recent Requests</h4>--}}
{{--            <table class="table table-bordered">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>Request ID</th>--}}
{{--                    <th>Roommate</th>--}}
{{--                    <th>Description</th>--}}
{{--                    <th>Status</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @foreach($recentRequests as $req)--}}
{{--                    <tr>--}}
{{--                        <td>#{{ $req->roommate_req_id }}</td>--}}
{{--                        <td>{{ $req->account->acc_name ?? '-' }}</td>--}}
{{--                        <td>{{ $req->roommate_req_des ?? '-' }}</td>--}}
{{--                        <td><span class="badge bg-secondary">{{ ucfirst($req->req_status) }}</span></td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}

{{--        <!-- Top Reviews -->--}}
{{--        <div class="table-responsive mt-4">--}}
{{--            <h4>Latest Reviews</h4>--}}
{{--            <table class="table table-bordered">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>Review ID</th>--}}
{{--                    <th>Reviewer</th>--}}
{{--                    <th>Comment</th>--}}
{{--                    <th>Rating</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @foreach($topReviews as $review)--}}
{{--                    <tr>--}}
{{--                        <td>#{{ $review->review_id }}</td>--}}
{{--                        <td>{{ $review->account->acc_name ?? '-' }}</td>--}}
{{--                        <td>{{ $review->review_comment }}</td>--}}
{{--                        <td>--}}
{{--                            @for($i = 1; $i <= $review->review_rate; $i++)--}}
{{--                                ⭐--}}
{{--                            @endfor--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}

    </div>

@endsection

@push('js')
    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var options = {
                series: [{
                    name: 'New Users',
                    data: [
                        @for ($i = 1; $i <= 12; $i++)
                            {{ $monthlyUnits[$i] ?? 0 }}{{ $i < 12 ? ',' : '' }}
                            @endfor
                    ]
                }],
                chart: {
                    type: 'line',
                    height: 350
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },
                colors: ['#1E88E5']
            };

            new ApexCharts(document.querySelector("#userChart"), options).render();

            // Pie Chart for Package Subscriptions
            var packageChart = {
                series: [
                    @foreach($subscriptionsPerPackage as $count)
                        {{ $count }}{{ !$loop->last ? ',' : '' }}
                        @endforeach
                ],
                chart: {
                    type: 'pie',
                    height: 350
                },
                labels: [
                    @foreach($subscriptionsPerPackage as $packId => $count)
                        '{{ $packageLabels[$packId] }}'{{ !$loop->last ? ',' : '' }}
                        @endforeach
                ],
                colors: ['#1E88E5', '#00C853', '#FFC107', '#d81b60', '#5e35b1'],
                legend: {
                    position: 'bottom'
                }
            };

            new ApexCharts(document.querySelector("#packageChart"), packageChart).render();
        });
    </script>

@endpush
