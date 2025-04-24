@extends('website.layouts.app_admin')

@section('title', 'Manage Reviews')

@section('content')
    <div class="container dashboard-content">
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">Manage Reviews</h4>
            </div>

            <table id="dataTable" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Reviewer</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>Unit</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reviews as $review)
                    <tr>
                        <td>{{ $review->review_id }}</td>
                        <td>{{ $review->account->acc_name ?? '-' }}</td>
                        <td>
                            @for($i = 1; $i <= $review->review_rate; $i++) ⭐ @endfor
                        </td>
                        <td>{{ $review->review_comment }}</td>
                        <td>{{ $review->unitAds->ua_address ?? '-' }}</td>
                        <td>{{ $review->review_dateTime }}</td>
                        <td class="action-buttons">
                            <form action="{{ route('admin.reviews.destroy', $review->review_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this review?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn2 btn-danger btn-sm">
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
