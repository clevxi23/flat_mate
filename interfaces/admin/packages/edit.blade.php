
@extends('website.layouts.app_admin')

@section('title', 'Edit Package')

@section('content')
    <div class="container dashboard-content">

        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Edit Package</h4>
                <div class="d-flex justify-content-between align-items-center mb-3">

                    <a href="{{ route('admin.packages.index') }}" class="btn btn2 btn-danger">
                        <i class="fas fa-arrow-right"></i> Back
                    </a>
                </div>
            </div>
            <form action="{{ route('admin.packages.update', $package->pack_id) }}" method="POST">
                @method('PUT')
                @include('website.admin.packages._form')

                <div class="text-end">
                    <button type="submit" class=" btn-success">Update Package</button>
                </div>
            </form>
        </div>
    </div>
@endsection
