@extends('website.layouts.app_admin')

@section('title', 'Listings Management')

@section('content')
    <div class="container dashboard-content">

        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">Manage Unit Ads</h4>

            </div>

            <table id="dataTable" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Owner</th>
                    <th>Address</th>
                    <th>Type</th>
                    <th>Price (SAR)</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($unitAds as $ad)
                    <tr>
                        <td>{{ $ad->ua_id }}</td>
                        <td>{{ $ad->account->acc_name ?? '-' }}</td>
                        <td>{{ $ad->ua_address }}</td>
                        <td>{{ $ad->ua_type }}</td>
                        <td>{{ number_format($ad->ua_rent_fees) }}</td>
                        <td>

            <span class="status-badge {{ $ad->ua_status == 'Available' ? 'status-available' : 'status-unavailable' }}">
                {{ $ad->ua_status ?? 'N/A' }}
            </span>
                        </td>
                        <td class="action-buttons">
                            <button class="btn btn2 btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $ad->ua_id }}">
                                <i class="fas fa-eye"></i>
                            </button>

                            <form action="{{ route('admin.listings.destroy', $ad->ua_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this unit ad?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn2 btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>

                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="detailsModal{{ $ad->ua_id }}" tabindex="-1" aria-labelledby="detailsModalLabel{{ $ad->ua_id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="detailsModalLabel{{ $ad->ua_id }}">Unit Ad #{{ $ad->ua_id }} Details</h5>
                                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body row">
                                    <div class="col-md-6 mb-3"><strong>Owner:</strong><br>{{ $ad->account->acc_name ?? '-' }}</div>
                                    <div class="col-md-6 mb-3"><strong>Address:</strong><br>{{ $ad->ua_address }}</div>
                                    <div class="col-md-4 mb-3"><strong>Type:</strong><br>{{ $ad->ua_type }}</div>
                                    <div class="col-md-4 mb-3"><strong>Rent:</strong><br>{{ number_format($ad->ua_rent_fees) }} SAR</div>
                                    <div class="col-md-4 mb-3"><strong>Availability:</strong><br>{{ $ad->ua_availability_start_date }}</div>

                                    <div class="col-md-4 mb-3"><strong>Lease Term:</strong><br>{{ $ad->ua_lease_term }}</div>
                                    <div class="col-md-4 mb-3"><strong>Bedrooms:</strong><br>{{ $ad->ua_num_of_bedrooms }}</div>
                                    <div class="col-md-4 mb-3"><strong>Roommates:</strong><br>{{ $ad->ua_num_of_roommates }}</div>

                                    <div class="col-md-4 mb-3"><strong>Size:</strong><br>{{ $ad->ua_size }} sqm</div>
                                    <div class="col-md-4 mb-3"><strong>Age:</strong><br>{{ $ad->ua_age }} years</div>
                                    <div class="col-md-4 mb-3"><strong>Pets Allowed:</strong><br>{{ $ad->ua_pets_allowed ? 'Yes' : 'No' }}</div>
                                    <div class="col-md-4 mb-3"><strong>Smoking Allowed:</strong><br>{{ $ad->ua_smoking_allowed ? 'Yes' : 'No' }}</div>

                                    <div class="col-md-12 mb-3">
                                        <strong>Description:</strong>
                                        <div class="border p-2 rounded mt-1">{{ $ad->ua_description }}</div>
                                    </div>

                                    @if($ad->facilities->count())
                                        <div class="col-md-12 mb-3">
                                            <strong>Facilities:</strong>
                                            <ul>
                                                @foreach($ad->facilities as $facility)
                                                    <li>{{ $facility->fac_title }} - {{ $facility->fac_description }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if($ad->images->count())
                                        <div class="col-md-12 mb-3">
                                            <strong>Images:</strong><br>
                                            @foreach($ad->images as $img)
                                                <img src="{{ asset($img->image_url) }}" width="100" class="me-2 mb-2" style="object-fit: cover;">
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection
