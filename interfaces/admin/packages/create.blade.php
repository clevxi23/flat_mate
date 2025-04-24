@extends('website.layouts.app_admin')

@section('title', 'Add Package')

@section('content')
    <div class="container dashboard-content">

        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Add New Package</h4>
                <div class="d-flex justify-content-between align-items-center mb-3">

                    <a href="{{ route('admin.packages.index') }}" class="btn btn2 btn-danger">
                        <i class="fas fa-arrow-right"></i> Back
                    </a>
                </div>
            </div>
        <form action="{{ route('admin.packages.store') }}" method="POST">
            @include('website.admin.packages._form')
            <div class="text-end">
                <button type="submit" class=" btn-success">Save Package</button>
            </div>
        </form>
    </div>
    </div>
@endsection
