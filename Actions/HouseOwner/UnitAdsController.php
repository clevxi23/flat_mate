<?php

namespace App\Http\Controllers\HouseOwner;

use App\Http\Controllers\Controller;
use App\Models\Subscribtion;
use App\Traits\UploadFile;
use Illuminate\Http\Request;
use App\Models\UnitAds;
use App\Models\Image;
use App\Models\Facilities;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UnitAdsController extends Controller
{
    use UploadFile;

    public function index()
    {
        $unitAds = UnitAds::where('acc_id', Auth::id())->with('images', 'facilities')->get();
        return view('website.owner.unit_ads.index', compact('unitAds'));
    }

    public function create()
    {
        return view('website.owner.unit_ads.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ua_deed_number' => 'nullable|numeric',
            'ua_address' => 'required|string|max:255',
            'ua_type' => 'required|string|in:Apartment,Villa,Studio',
            'ua_size' => 'required|numeric|min:0',
            'ua_rent_duration' => 'required|string|max:50',
            'ua_rent_fees' => 'required|numeric|min:0',
            'ua_availability_start_date' => 'required|date',
            'ua_lease_term' => 'required|string|max:50',
            'ua_age' => 'required|integer|min:0',
            'ua_num_of_roommates' => 'required|integer|min:0',
            'ua_num_of_bedrooms' => 'required|integer|min:0',
            'ua_description' => 'required|string',
            'ua_pets_allowed' => 'nullable|boolean',
            'ua_smoking_allowed' => 'nullable|boolean',
            'ua_city' => 'nullable|string|max:100',
            'ua_streetname' => 'nullable|string|max:100',
            'ua_streetnum' => 'nullable|string|max:50',
            'ua_zip' => 'nullable|string|max:20',
            'ua_unitnum' => 'nullable|string|max:50',


            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'facilities' => 'nullable|array',
            'facilities.*' => 'nullable|string|max:255',
            'facility_descriptions.*' => 'nullable|string|max:255',

        ]);
        $ownerId = Auth::id();
        $existingAdsCount = UnitAds::where('acc_id', $ownerId)->count();

        $subscription = Subscribtion::where('acc_id', $ownerId)
            ->where('sub_end_date', '>', now())
            ->first();

        $limit = $subscription ? $subscription->sub_number_of_ads : 10;

        if ($existingAdsCount >= $limit) {
            return redirect()->route('owner.unit_ads.index')
                ->with('error', 'You have reached your ad posting limit. Please upgrade your subscription.');
        }

        $unitAd = UnitAds::create([
            'ua_deed_number' => $request->ua_deed_number,
            'ua_address' => $request->ua_address,
            'ua_type' => $request->ua_type,
            'ua_size' => $request->ua_size,
            'ua_rent_duration' => $request->ua_rent_duration,
            'ua_rent_fees' => $request->ua_rent_fees,
            'ua_availability_start_date' => $request->ua_availability_start_date,
            'ua_lease_term' => $request->ua_lease_term,
            'ua_age' => $request->ua_age,
            'ua_num_of_roommates' => $request->ua_num_of_roommates,
            'ua_num_of_bedrooms' => $request->ua_num_of_bedrooms,
            'ua_description' => $request->ua_description,
            'ua_pets_allowed' => $request->ua_pets_allowed ?? 0,
            'ua_smoking_allowed' => $request->ua_smoking_allowed ?? 0,
            'acc_id' => Auth::id(),

            'ua_city' => $request->ua_city,
            'ua_streetname' => $request->ua_streetname,
            'ua_streetnum' => $request->ua_streetnum,
            'ua_zip' => $request->ua_zip,
            'ua_unitnum' => $request->ua_unitnum,

        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $this->upload($file);
                Image::create([
                    'image_url' => $path,
                    'ua_id' => $unitAd->ua_id,
                ]);
            }
        }

        if ($request->facilities) {
            foreach ($request->facilities as $index => $facility) {
                if (!empty($facility)) {
                    Facilities::create([
                        'fac_title' => $facility,
                        'fac_description' => $request->facility_descriptions[$index] ?? '',
                        'ua_id' => $unitAd->ua_id,
                    ]);
                }
            }
        }
        if ($subscription) {
            $subscription->decrement('sub_number_of_ads');
        }
        return redirect()->route('owner.unit_ads.index')->with('success', 'Unit Ad added successfully.');
    }

    public function show($id)
    {
        $unitAd = UnitAds::where('acc_id', Auth::id())->with('images', 'facilities')->findOrFail($id);
        return view('website.owner.unit_ads.show', compact('unitAd'));
    }

    public function edit($id)
    {
        $unitAd = UnitAds::where('acc_id', Auth::id())->with('images', 'facilities')->findOrFail($id);
        return view('website.owner.unit_ads.edit', compact('unitAd'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ua_deed_number' => 'nullable|numeric',
            'ua_address' => 'required|string|max:255',
            'ua_type' => 'required|string|in:Apartment,Villa,Studio',
            'ua_size' => 'required|numeric|min:0',
            'ua_rent_duration' => 'required|string|max:50',
            'ua_rent_fees' => 'required|numeric|min:0',
            'ua_availability_start_date' => 'required|date',
            'ua_lease_term' => 'required|string|max:50',
            'ua_age' => 'required|integer|min:0',
            'ua_num_of_roommates' => 'required|integer|min:0',
            'ua_num_of_bedrooms' => 'required|integer|min:0',
            'ua_description' => 'required|string',
            'ua_pets_allowed' => 'nullable|boolean',
            'ua_smoking_allowed' => 'nullable|boolean',

            'ua_city' => 'nullable|string|max:100',
            'ua_streetname' => 'nullable|string|max:100',
            'ua_streetnum' => 'nullable|string|max:50',
            'ua_zip' => 'nullable|string|max:20',
            'ua_unitnum' => 'nullable|string|max:50',



            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'facilities' => 'nullable|array',
            'facilities.*' => 'nullable|string|max:255',
            'facility_descriptions.*' => 'nullable|string|max:255',
        ]);

        $unitAd = UnitAds::where('acc_id', Auth::id())->findOrFail($id);
        $unitAd->update([
            'ua_deed_number' => $request->ua_deed_number,
            'ua_address' => $request->ua_address,
            'ua_type' => $request->ua_type,
            'ua_size' => $request->ua_size,
            'ua_rent_duration' => $request->ua_rent_duration,
            'ua_rent_fees' => $request->ua_rent_fees,
            'ua_availability_start_date' => $request->ua_availability_start_date,
            'ua_lease_term' => $request->ua_lease_term,
            'ua_age' => $request->ua_age,
            'ua_num_of_roommates' => $request->ua_num_of_roommates,
            'ua_num_of_bedrooms' => $request->ua_num_of_bedrooms,
            'ua_description' => $request->ua_description,
            'ua_pets_allowed' => $request->ua_pets_allowed ?? 0,
            'ua_smoking_allowed' => $request->ua_smoking_allowed ?? 0,

            'ua_city' => $request->ua_city,
            'ua_streetname' => $request->ua_streetname,
            'ua_streetnum' => $request->ua_streetnum,
            'ua_zip' => $request->ua_zip,
            'ua_unitnum' => $request->ua_unitnum,

        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $this->upload($file);
                Image::create([
                    'image_url' => $path,
                    'ua_id' => $unitAd->ua_id,
                ]);
            }
        }

        // Handle facilities: Delete old ones and add new ones
        if ($request->facilities) {
            Facilities::where('ua_id', $unitAd->ua_id)->delete();
            foreach ($request->facilities as $index => $facility) {
                if (!empty($facility)) { // Only create if facility title is provided
                    Facilities::create([
                        'fac_title' => $facility,
                        'fac_description' => $request->facility_descriptions[$index] ?? '',
                        'ua_id' => $unitAd->ua_id,
                    ]);
                }
            }
        }

        return redirect()->route('owner.unit_ads.index')->with('success', 'Unit Ad updated successfully.');
    }

    public function destroy($id)
    {
        $unitAd = UnitAds::where('acc_id', Auth::id())->findOrFail($id);

        // Delete associated images from storage and database
        foreach ($unitAd->images as $image) {
            Storage::disk('public')->delete($image->image_url);
            $image->delete();
        }

        // Delete associated facilities
        Facilities::where('ua_id', $unitAd->ua_id)->delete();

        // Delete the unit ad
        $unitAd->delete();
        return redirect()->route('owner.unit_ads.index')->with('success', 'Unit Ad deleted successfully.');
    }
}
