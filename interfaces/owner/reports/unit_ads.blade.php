@extends('website.layouts.app_owner')

@section('title', 'My Unit Ads Report')

@section('content')
    <div class="container dashboard-content">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">My Unit Ads Report</h5>
                <p class="text-muted">This report gives an overview of all unit ads you've posted, including their availability, room capacity, and interest level from potential roommates.</p>

            </div>
            <div class="card-body table-responsive">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <p></p>
                    <a href="{{ route('owner.reports.index') }}" class="btn btn2 btn-danger">
                        <i class="fas fa-arrow-right"></i> Back
                    </a>
                </div>
                <table class="table table-bordered table-hover" id="dataTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Deed Number</th>
                        <th>Type</th>
{{--                        <th>Rent (SAR)</th>--}}
                        <th>Availability</th>
                        <th>Bedrooms</th>
{{--                        <th>Roommates</th>--}}
{{--                        <th>Facilities</th>--}}
                        <th>Images</th>
                        <th>Likes</th>
                        <th>Views</th>
                        <th>Avg. Rating</th>
{{--                        <th>Roommate Requests</th>--}}
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($ads as $ad)
                        <tr>
                            <td>{{ $ad->ua_id }}</td>
                            <td>{{ $ad->ua_deed_number }}</td>
                            <td>{{ $ad->ua_type }}</td>
{{--                            <td>{{ number_format($ad->ua_rent_fees, 2) }}</td>--}}
                            <td>{{ $ad->ua_availability_start_date }}</td>
{{--                            <td>{{ $ad->ua_num_of_bedrooms }}</td>--}}
                            <td>{{ $ad->ua_num_of_roommates }}</td>
{{--                            <td>{{ $ad->facilities_count }}</td>--}}
                            <td>{{ $ad->images_count }}</td>
                            <td>{{ $ad->likes_count }}</td>
                            <td>{{ $ad->views_count }}</td>
                            <td>{{ number_format($ad->reviews_avg_rev_rating, 1) ?? '-' }}</td>
{{--                            <td>{{ $ad->roommateRequests->count() }}</td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
