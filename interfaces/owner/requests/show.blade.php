@extends('website.layouts.app_owner')

@section('title', 'Request Details')

@section('content')
    <div class="container dashboard-content">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Roommate Request #{{ $request->roommate_req_id }}</h5>
            </div>
            <div class="card-body row">
                <div class="col-md-6 mb-3">
                    <strong>Unit Address:</strong><br>
                    {{ $request->unitAd->ua_address ?? '-' }}
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Requester Name:</strong><br>
                    {{ $request->account->acc_name ?? '-' }}
                </div>

                <div class="col-md-4 mb-3">
                    <strong>Gender:</strong><br>
                    {{ $request->roommate_req_gender ?? '-' }}
                </div>

                <div class="col-md-4 mb-3">
                    <strong>Age:</strong><br>
                    {{ $request->roommate_req_age ?? '-' }}
                </div>

                <div class="col-md-4 mb-3">
                    <strong>Employment:</strong><br>
                    {{ $request->roommate_req_emp_status ?? '-' }}
                </div>

                <div class="col-md-4 mb-3">
                    <strong>Smoking:</strong><br>
                    {{ $request->roommate_req_smoking ? 'Yes' : 'No' }}
                </div>

                <div class="col-md-4 mb-3">
                    <strong>Has Children:</strong><br>
                    {{ $request->roommate_req_child ? 'Yes' : 'No' }}
                </div>

                <div class="col-md-4 mb-3">
                    <strong>Has Pets:</strong><br>
                    {{ $request->roommate_req_pets_ref ? 'Yes' : 'No' }}
                </div>

                <div class="col-md-4 mb-3">
                    <strong>Number of Roommates Requested:</strong><br>
                    {{ $request->roommate_req_num_of_roommate ?? '-' }}
                </div>

                <div class="col-md-4 mb-3">
                    <strong>Owner Action:</strong><br>
                    <span class="badge bg-{{
                    $request->owner_action === 'accepted' ? 'success' :
                    ($request->owner_action === 'rejected' ? 'danger' :
                    ($request->owner_action === 'invited' ? 'info' : 'secondary'))
                }}">
                    {{ ucfirst($request->owner_action) }}
                </span>
                </div>

                <div class="col-md-12 mb-3">
                    <strong>Description:</strong><br>
                    {{ $request->roommate_req_des ?? '-' }}
                </div>
            </div>

            <div class="card-footer text-end">
                <a href="{{ route('owner.roommate_requests.index') }}" class=" btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>
@endsection
