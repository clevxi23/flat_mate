@extends('website.layouts.app_owner')

@section('title', 'Manage Unit Ads')

@section('content')
    <div class="container dashboard-content">
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">Your Unit Ads</h4>
                <a href="{{ route('owner.unit_ads.create') }}" class="btn btn2 btn-primary">
                    <i class="fas fa-plus"></i> Add New
                </a>
            </div>

            <table id="dataTable" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Address</th>
                    <th>Type</th>
                    <th>Price (SAR)</th>
                    <th>Availability</th>
                    <th>Likes</th>
                    <th>Views</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($unitAds as $unitAd)
                    <tr>
                        <td>{{ $unitAd->ua_id }}</td>
                        <td>{{ $unitAd->ua_address }}</td>
                        <td>{{ $unitAd->ua_type }}</td>
                        <td>{{ number_format($unitAd->ua_rent_fees, 2) }}</td>
                        <td>
                            <span class="status-badge {{ $unitAd->ua_availability_start_date > now() ? 'status-unavailable' : 'status-available' }}">
                                {{ $unitAd->ua_availability_start_date > now() ? 'Not Available' : 'Available' }}
                            </span>
                        </td>
                        <td>{{count($unitAd->likes)}} <i class="fa fa-heart text-danger"></i></td>
                        <td>{{count($unitAd->views)}} <i class="fa fa-eye text-primary"></i></td>
                        <td class="action-buttons">
                            <a href="{{ route('owner.unit_ads.show', $unitAd->ua_id) }}"
                               class="btn btn2 btn-info btn-sm"
                               title="View">
                                <i class="fas fa-eye text-white"></i>
                            </a>

                            <a href="{{ route('owner.unit_ads.edit', $unitAd->ua_id) }}" class="btn btn2 btn-primary btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('owner.unit_ads.destroy', $unitAd->ua_id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn2 btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this unit?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
