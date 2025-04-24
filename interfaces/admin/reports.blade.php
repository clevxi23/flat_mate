@extends('website.layouts.app_admin')

@section('title', 'Reports & Analytics')

@section('content')
    <div class="container dashboard-content">
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">Reports & Analytics</h4>
            </div>

            <!-- Subscription Conversion Rate -->
            <div class="alert alert-info">
                <strong>Subscription Conversion Rate:</strong> {{ $subscriptionConversionRate }}% ({{ $subscribedOwners }}/{{ $totalOwners }} Owners Subscribed)
            </div>

            <!-- Popular Listings -->
            <div class="table-responsive mt-4">
                <h4>Top 5 Most Requested Unit Ads</h4>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Owner</th>
                        <th>Address</th>
                        <th>Type</th>
                        <th>Requests</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($popularUnits as $unit)
                        <tr>
                            <td>{{ $unit->ua_id }}</td>
                            <td>{{ $unit->account->acc_name ?? '-' }}</td>
                            <td>{{ $unit->ua_address }}</td>
                            <td>{{ $unit->ua_type }}</td>
                            <td>{{ $unit->roommate_requests_count }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Avg Ratings Line Chart -->
            <div class="chart-container mt-5">
                <h4 class="text-center">Average Rating per Unit Ad</h4>
                <div id="avgRatingChart"></div>
            </div>

            <!-- Top Rated Users -->
            <div class="table-responsive mt-5">
                <h4>Top 5 Highest Rated Users</h4>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Avg. Rating</th>
                        <th>Total Reviews</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($topRatedUsers as $user)
                        <tr>
                            <td>{{ $user->acc_name }}</td>
                            <td>{{ $user->acc_email }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $user->acc_type)) }}</td>
                            <td>{{ number_format($user->avg_rating ?? 0, 2) }}</td>
                            <td>{{ $user->reviews_count }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Facility Usage Stats -->
            <div class="table-responsive mt-5">
                <h4>Most Used Facilities</h4>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Facility</th>
                        <th>Used In Units</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($facilityStats as $facility)
                        <tr>
                            <td>{{ $facility->fac_title }}</td>
                            <td>{{ $facility->total }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var options = {
                chart: {
                    type: 'line',
                    height: 350
                },
                series: [{
                    name: 'Avg Rating',
                    data: @json(array_values($avgRatings->pluck('avg_rating', 'ua_address')->toArray()))
                }],
                xaxis: {
                    categories: @json(array_values($avgRatings->pluck('ua_address')->toArray()))
                },
                colors: ['#FFA726']
            };

            var chart = new ApexCharts(document.querySelector("#avgRatingChart"), options);
            chart.render();
        });
    </script>
@endpush
