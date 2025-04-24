@extends('website.layouts.app_admin')

@section('title', 'Manage Packages')

@section('content')
    <div class="container dashboard-content">
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Subscription Packages</h4>
                <div class="d-flex justify-content-between align-items-center mb-3">

                    <a href="{{ route('admin.packages.create') }}" class="btn p-2 btn-primary">+ Add</a>
                </div>
            </div>



        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

            <table id="dataTable" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Package Name</th>
                <th>Fee</th>
                <th>Duration</th>
                <th>Status</th>
                <th>Privileges</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($packages as $package)
                <tr>
                    <td>{{ $package->pack_id }}</td>
                    <td>{{ $package->pack_name }}</td>
                    <td>{{ number_format($package->pack_fee, 2) }} SAR</td>
                    <td>{{ $package->pack_duration }}</td>
                    <td>{{ ucfirst($package->pack_status) }}</td>
                    <td>{{ $package->pack_privillages }}</td>
                    <td>
                        <a href="{{ route('admin.packages.edit', $package->pack_id) }}" class="btn btn2 btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.packages.destroy', $package->pack_id) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger btn2" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
