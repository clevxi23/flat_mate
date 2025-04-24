@extends('website.layouts.app_admin')

@section('title', 'Subscription Package')

@section('content')
    <div class="container dashboard-content">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Manage Subscription Package</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.packages.save') }}" method="POST">
                    @csrf

                   <div class="row">
                       <div class="mb-3 col-md-6">
                           <label class="form-label">Package Name <span class="text-danger">*</span></label>
                           <input type="text" name="pack_name" class="form-control" required value="{{ old('pack_name', $package->pack_name ?? '') }}">
                       </div>

                       <div class="mb-3 col-md-6">
                           <label class="form-label">Fee (SAR) <span class="text-danger">*</span></label>
                           <input type="number" name="pack_fee" class="form-control" required value="{{ old('pack_fee', $package->pack_fee ?? '') }}">
                       </div>


                       <div class="mb-3 col-md-6">
                           <label class="form-label">Duration (e.g., 1 Month, 3 Months) <span class="text-danger">*</span></label>
                           <input type="text" name="pack_duration" class="form-control" required value="{{ old('pack_duration', $package->pack_duration ?? '') }}">
                       </div>

                       <div class="mb-3 col-md-6">
                           <label class="form-label">Status <span class="text-danger">*</span></label>
                           <select name="pack_status" class="form-control" required>
                               <option value="active" {{ (old('pack_status', $package->pack_status ?? '') === 'active') ? 'selected' : '' }}>Active</option>
                               <option value="inactive" {{ (old('pack_status', $package->pack_status ?? '') === 'inactive') ? 'selected' : '' }}>Inactive</option>
                           </select>
                       </div>

                       <div class="mb-3 col-md-12">
                           <label class="form-label">Privileges <span class="text-danger">*</span></label>
                           <textarea name="pack_privillages" rows="3" class="form-control" required>{{ old('pack_privillages', $package->pack_privillages ?? '') }}</textarea>
                       </div>

                   </div>

                    <div class="text-end">
                        <button type="submit" class=" btn-success">Save Package</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
