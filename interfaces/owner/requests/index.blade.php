@extends('website.layouts.app_owner')

@section('title', 'Roommate Requests')

@section('content')
    <div class="container dashboard-content">
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">Roommate Requests for Your Units</h4>
            </div>

            <table id="dataTable" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Unit Address</th>
                    <th>From</th>
                    <th>Roommates</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($requests as $request)
                    <tr>
                        <td>{{ $request->roommate_req_id }}</td>
                        <td>{{ $request->unitAd->ua_address ?? '-' }}</td>
                        <td>{{ $request->account->acc_name ?? '-' }}</td>
                        <td>{{ $request->roommate_req_num_of_roommate }}</td>
                        <td>
    <span class="badge bg-{{
        $request->owner_action === 'accepted' ? 'success' :
        ($request->owner_action === 'rejected' ? 'danger' :
        ($request->owner_action === 'invited' ? 'info' : 'secondary'))
    }}">
        {{ ucfirst($request->owner_action) }}
    </span>
                        </td>

                        <td>
                            <a style="margin-right: 7px;" class="p-2 l-2 btn-primary btn-sm" href="{{ route('owner.roommate_requests.show', $request->roommate_req_id) }}">
                                View
                            </a>
                            <form action="{{ route('owner.roommate_requests.action', $request->roommate_req_id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="action" value="accepted">
                                <button type="submit" class=" btn-success btn-sm">Accept</button>
                            </form>

                            <form action="{{ route('owner.roommate_requests.action', $request->roommate_req_id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="action" value="rejected">
                                <button type="submit" class=" btn-danger btn-sm">Reject</button>
                            </form>

                            <form action="{{ route('owner.roommate_requests.action', $request->roommate_req_id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="action" value="invited">
                                <button type="submit" class=" btn-info text-white btn-sm">Invite</button>
                            </form>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
