<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UnitAds;

class ListingController extends Controller
{
    public function index()
    {
        $unitAds = UnitAds::with(['account', 'images', 'facilities'])->get();
        return view('website.admin.listings', compact('unitAds'));
    }

    public function destroy($id)
    {
        $listing = UnitAds::findOrFail($id);
        foreach ($listing->images as $image) {
            $image->delete();
        }
        $listing->facilities()->delete();
        $listing->delete();
        return redirect()->route('admin.listings')->with('success', 'Listing deleted successfully.');
    }

}
