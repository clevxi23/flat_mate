@extends('website.layouts.app_admin')

@section('title', 'User Management')

@section('content')
    <div class="container dashboard-content">
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">User Management</h4>
            </div>

            <table id="dataTable" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Role</th>
                    <th>Points</th>
                    <th>Total Count</th>
                    <th>Total Count</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->acc_id }}</td>
                        <td>{{ $user->acc_name }}</td>
                        <td>{{ $user->acc_email }}</td>
                        <td>{{ $user->acc_phone }}</td>
                        <td>{{ $user->acc_gender }}</td>
                        <td>{{ $user->acc_address }}</td>
                        <td>{{ ucfirst(str_replace('_', ' ', $user->acc_type)) }}</td>
                        <td>{{ $user->acc_point }}</td>
                        <td>{{ $user->acc_total_count }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
