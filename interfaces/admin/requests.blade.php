@extends('website.layouts.app_admin')

@section('title', 'Requests Management')

@section('content')
    <div class="container dashboard-content">

        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">Manage Requests</h4>

            </div>

            <table id="dataTable" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Requester</th>
                    <th>Request Type</th>
                    <th>Details</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <!-- Static Data -->
                <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>Roommate Request</td>
                    <td>Looking for a shared apartment in Riyadh</td>
                    <td>
                        <span class="status-badge status-pending">Pending</span>
                    </td>
                    <td class="action-buttons">
                        <a href="{{ route('admin.users', 1) }}" class="btn btn2 btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn2 btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Sarah Ahmed</td>
                    <td>Rental Request</td>
                    <td>Interested in a villa in Jeddah</td>
                    <td>
                        <span class="status-badge status-approved">Approved</span>
                    </td>
                    <td class="action-buttons">
                        <a href="{{ route('admin.users', 2) }}" class="btn btn2 btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn2 btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Ali Hassan</td>
                    <td>Roommate Match</td>
                    <td>Searching for a roommate in Dammam</td>
                    <td>
                        <span class="status-badge status-rejected">Rejected</span>
                    </td>
                    <td class="action-buttons">
                        <a href="{{ route('admin.users', 3) }}" class="btn btn2 btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn2 btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Ahmed Alsharif</td>
                    <td>Rental Inquiry</td>
                    <td>Needs more details about an apartment in Mecca</td>
                    <td>
                        <span class="status-badge status-pending">Pending</span>
                    </td>
                    <td class="action-buttons">
                        <a href="{{ route('admin.users', 4) }}" class="btn btn2 btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn2 btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
