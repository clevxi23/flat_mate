<div class="container card-body">
    <div class="card">
        <div class="card-body">
            <!-- Back Button -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <p></p>
                <a href="{{ route('owner.unit_ads.index') }}" class="btn btn2 btn-danger">
                    <i class="fas fa-arrow-right"></i> Back
                </a>
            </div>

            <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($method === 'PUT')
                    @method('PUT')
                @endif

                <!-- Basic Unit Information -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Basic Unit Information</h5>
                    </div>
                    <div class="card-body row">
                        <!-- Address -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Address <span class="text-danger">*</span></label>
                            <input type="text" name="ua_address" class="form-control" required
                                   value="{{ $unitAd->ua_address ?? old('ua_address') }}">
                            <small class="form-text text-muted">Enter the full address of the unit.</small>
                            @error('ua_address')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>

                        <!-- Type -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Type <span class="text-danger">*</span></label>
                            <select name="ua_type" class="form-control" required>
                                <option value="Apartment" {{ (isset($unitAd) && $unitAd->ua_type == 'Apartment') ? 'selected' : '' }}>Apartment</option>
                                <option value="Villa" {{ (isset($unitAd) && $unitAd->ua_type == 'Villa') ? 'selected' : '' }}>Villa</option>
                                <option value="Studio" {{ (isset($unitAd) && $unitAd->ua_type == 'Studio') ? 'selected' : '' }}>Studio</option>
                            </select>
                            <small class="form-text text-muted">Select the unit type.</small>
                            @error('ua_type')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>

                        <!-- Size -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Size (sqm) <span class="text-danger">*</span></label>
                            <input type="number" step="0.1" name="ua_size" class="form-control" required
                                   value="{{ $unitAd->ua_size ?? old('ua_size') }}">
                            <small class="form-text text-muted">Enter the size in square meters.</small>
                            @error('ua_size')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>

                        <!-- Rent Duration -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Rent Duration <span class="text-danger">*</span></label>
                            <input type="text" name="ua_rent_duration" class="form-control" required
                                   value="{{ $unitAd->ua_rent_duration ?? old('ua_rent_duration') }}">
                            <small class="form-text text-muted">e.g., "Monthly", "Yearly".</small>
                            @error('ua_rent_duration')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>

                        <!-- Rent Fees -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Rent Fees (SAR) <span class="text-danger">*</span></label>
                            <input type="number" name="ua_rent_fees" class="form-control" required
                                   value="{{ $unitAd->ua_rent_fees ?? old('ua_rent_fees') }}">
                            <small class="form-text text-muted">Enter the rental fee.</small>
                            @error('ua_rent_fees')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>

                        <!-- Availability Date -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Availability Date <span class="text-danger">*</span></label>
                            <input type="date" name="ua_availability_start_date" class="form-control" required
                                   value="{{ $unitAd->ua_availability_start_date ?? old('ua_availability_start_date') }}">
                            <small class="form-text text-muted">Select the date the unit becomes available.</small>
                            @error('ua_availability_start_date')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>

                        <!-- Lease Term -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Lease Term <span class="text-danger">*</span></label>
                            <input type="text" name="ua_lease_term" class="form-control" required
                                   value="{{ $unitAd->ua_lease_term ?? old('ua_lease_term') }}">
                            <small class="form-text text-muted">Example: "12 months".</small>
                            @error('ua_lease_term')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                        <!-- Real Estate Deed -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Real Estate Deed</label>
                            <input type="text" name="ua_deed_number" class="form-control"
                                   value="{{ $unitAd->ua_deed_number ?? old('ua_deed_number') }}">
                            <small class="form-text text-muted">Enter the deed registration number (optional).</small>
                            @error('ua_deed_number')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                        <!-- Age -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Unit Age (Years) <span class="text-danger">*</span></label>
                            <input type="number" name="ua_age" class="form-control" required
                                   value="{{ $unitAd->ua_age ?? old('ua_age') }}">
                            <small class="form-text text-muted">Enter the age of the unit in years.</small>
                            @error('ua_age')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <!-- Room Details -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Room Details</h5>
                    </div>
                    <div class="card-body row">
                        <!-- Number of Roommates -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Number of Roommates <span class="text-danger">*</span></label>
                            <input type="number" name="ua_num_of_roommates" class="form-control" required
                                   value="{{ $unitAd->ua_num_of_roommates ?? old('ua_num_of_roommates') }}">
                            <small class="form-text text-muted">Enter the total number of roommates allowed.</small>
                            @error('ua_num_of_roommates')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>

                        <!-- Number of Bedrooms -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Number of Bedrooms <span class="text-danger">*</span></label>
                            <input type="number" name="ua_num_of_bedrooms" class="form-control" required
                                   value="{{ $unitAd->ua_num_of_bedrooms ?? old('ua_num_of_bedrooms') }}">
                            <small class="form-text text-muted">Enter the number of bedrooms.</small>
                            @error('ua_num_of_bedrooms')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Description</h5>
                    </div>
                    <div class="card-body">
                        <label class="form-label">Unit Description <span class="text-danger">*</span></label>
                        <textarea name="ua_description" class="form-control" rows="5" required>{{ $unitAd->ua_description ?? old('ua_description') }}</textarea>
                        <small class="form-text text-muted">Provide a detailed description of the unit.</small>
                        @error('ua_description')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- Preferences -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Preferences</h5>
                    </div>
                    <div class="card-body row">
                        <!-- Pets Allowed (Switch) -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label d-block">Pets Allowed</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="ua_pets_allowed"
                                       value="1"
                                       id="petsSwitch"
                                    {{ (isset($unitAd) && $unitAd->ua_pets_allowed) ? 'checked' : (old('ua_pets_allowed') ? 'checked' : '') }}>
                                <label class="form-check-label" for="petsSwitch">Yes</label>
                            </div>
                            @error('ua_pets_allowed')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>

                        <!-- Smoking Allowed (Switch) -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label d-block">Smoking Allowed</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="ua_smoking_allowed"
                                       value="1"
                                       id="smokingSwitch"
                                    {{ (isset($unitAd) && $unitAd->ua_smoking_allowed) ? 'checked' : (old('ua_smoking_allowed') ? 'checked' : '') }}>
                                <label class="form-check-label" for="smokingSwitch">Yes</label>
                            </div>
                            @error('ua_smoking_allowed')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>


                    </div>
                </div>

                <!-- Upload Images -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Upload Images</h5>
                    </div>
                    <div class="card-body">
                        <input type="file" name="images[]" class="form-control" multiple id="imageUpload">
                        <small class="form-text text-muted">Upload multiple images of the unit.</small>
                        @error('images')<div class="text-danger">{{ $message }}</div>@enderror
                        <div id="imagePreview" class="mt-3">
                            <!-- JS will show preview of selected images -->
                        </div>
                        @if(isset($unitAd) && $unitAd->images->count())
                            <div class="mt-3">
                                <h6>Existing Images:</h6>
                                @foreach($unitAd->images as $image)
                                    <img src="{{ asset($image->image_url) }}" width="100" class="me-2 mb-2">
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Facilities -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary d-flex justify-content-between text-white">
                        <h5 class="mb-0">Facilities</h5>
                    </div>
                    <div class="card-body" id="facilities-container">
                        <h6 class="mb-3">Select Available Facilities:</h6>
                        @php
                            $fixedFacilities = ['WiFi', 'Internet', 'Air Conditioning', 'Washing Machine', 'Refrigerator'];
                            $existingFacilities = isset($unitAd) ? $unitAd->facilities->pluck('fac_title')->toArray() : [];
                        @endphp

                        <div class="row mb-4">
                            @foreach($fixedFacilities as $facility)
                                <div class="col-md-4 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               name="facilities[]"
                                               value="{{ $facility }}"
                                               id="fixed_facility_{{ $loop->index }}"
                                            {{ in_array($facility, old('facilities', $existingFacilities)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="fixed_facility_{{ $loop->index }}">
                                            {{ $facility }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <h6 class="mb-2">Add Custom Facilities:</h6>

                        @php
                            $customFacilities = isset($unitAd)
                                ? $unitAd->facilities->filter(fn($fac) => !in_array($fac->fac_title, $fixedFacilities))
                                : collect();
                        @endphp

                        @if($customFacilities->count())
                            @foreach($customFacilities as $facility)
                                <div class="d-flex mb-2">
                                    <input type="text" name="facilities[]" class="form-control" placeholder="Facility Title" value="{{ $facility->fac_title }}">
                                    <input type="text" name="facility_descriptions[]" class="form-control ms-2" placeholder="Facility Description" value="{{ $facility->fac_description }}">
                                    <button style="    padding: 0px 14px;"  type="button" class="btn btn-danger btn-sm remove-facility ms-2"><i class="fa fa-trash"></i></button>
                                </div>
                            @endforeach
                        @else
                            <div class="d-flex mb-2">
                                <input type="text" name="facilities[]" class="form-control" placeholder="Facility Title">
                                <input type="text" name="facility_descriptions[]" class="form-control ms-2" placeholder="Facility Description">
                                <button style="    padding: 0px 14px;" type="button" class="btn btn-danger remove-facility ms-2"><i class="fa fa-trash"></i></button>
                            </div>
                        @endif

                        <button type="button" class="btn btn-success p-2 rounded-3 mt-2" id="add-facility">Add More</button>
                    </div>

                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success w-25 mb-3 mt-3">
                        <i class="fas fa-save"></i> Save Unit Ad
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Add new facility input row
    document.getElementById('add-facility').addEventListener('click', function () {
        let container = document.getElementById('facilities-container');
        let facilityRow = document.createElement('div');
        facilityRow.classList.add('d-flex', 'mb-2');
        facilityRow.innerHTML = `
            <input type="text" name="facilities[]" class="form-control" placeholder="Facility Title">
            <input type="text" name="facility_descriptions[]" class="form-control ms-2" placeholder="Facility Description">
            <button style="    padding: 0px 14px;" type="button" class="btn btn-danger remove-facility ms-2"><i class="fa fa-trash"></i></button>
        `;
        container.insertBefore(facilityRow, this);
    });

    // Remove facility row
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-facility')) {
            e.target.parentElement.remove();
        }
    });

    // Image preview for file uploads
    document.getElementById('imageUpload').addEventListener('change', function () {
        let preview = document.getElementById('imagePreview');
        preview.innerHTML = '';
        for (let file of this.files) {
            let img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.width = 100;
            img.classList.add('me-2', 'mb-2');
            preview.appendChild(img);
        }
    });
</script>
