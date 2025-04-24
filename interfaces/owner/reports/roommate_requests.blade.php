@extends('website.layouts.app_owner')

@section('title', 'Roommate Requests Report')

@section('content')
    <div class="container dashboard-content">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Roommate Requests Report</h5>
                <p class="text-muted">This report summarizes all roommate requests submitted to your unit ads, showing key details about the requesters and your response status.</p>

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
                        <th>ID</th>
                        <th>Unit</th>
                        <th>From</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Employment</th>
                        <th>Pets</th>
                        <th>Smoking</th>
                        <th>Children</th>
                        <th>Roommates</th>
                        <th>Owner Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($requests as $req)
                        <tr>
                            <td>#{{ $req->roommate_req_id }}</td>
                            <td>{{ $req->unitAd->ua_address ?? '-' }}</td>
                            <td>{{ $req->account->acc_name ?? '-' }}</td>
                            <td>{{ $req->roommate_req_gender }}</td>
                            <td>{{ $req->roommate_req_age }}</td>
                            <td>{{ $req->roommate_req_emp_status }}</td>
                            <td>{{ $req->roommate_req_pets_ref ? 'Yes' : 'No' }}</td>
                            <td>{{ $req->roommate_req_smoking ? 'Yes' : 'No' }}</td>
                            <td>{{ $req->roommate_req_child ? 'Yes' : 'No' }}</td>
                            <td>{{ $req->roommate_req_num_of_roommate }}</td>
                            <td>
                                <span class="badge bg-{{
                                    $req->owner_action === 'accepted' ? 'success' :
                                    ($req->owner_action === 'rejected' ? 'danger' :
                                    ($req->owner_action === 'invited' ? 'info' : 'secondary'))
                                }}">
                                    {{ ucfirst($req->owner_action) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
