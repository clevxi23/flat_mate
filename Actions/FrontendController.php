<?php

namespace App\Http\Controllers;

use App\Models\View;
use Illuminate\Http\Request;
use App\Models\UnitAds;
use App\Models\Package;

class FrontendController extends Controller
{
    public function home(Request $request)
    {
        $premiumAds = UnitAds::with('images')
            ->whereHas('account.subscriptions', function ($q) {
                $q->where('sub_end_date', '>', now());
            })
            ->latest('ua_id')
            ->take(6)
            ->get();
        $unitAds =  UnitAds::paginate(9);
        $unitAd = UnitAds::with(['images', 'facilities', 'reviews.account'])->findOrFail(1);
        return view('website.home', compact('premiumAds', 'unitAds', 'unitAd'));
    }

    public function about()
    {
        return view('website.about');
    }

    public function contact()
    {
        return view('website.contact');
    }

    public function unitAds(Request $request)
    {
//        $query = UnitAds::query();
        $query = UnitAds::with('account', 'images')
            ->leftJoin('subscribtion', function ($join) {
                $join->on('unit_ads.acc_id', '=', 'subscribtion.acc_id')
                    ->where('subscribtion.sub_end_date', '>', now());
            })
            ->orderByRaw('subscribtion.sub_id IS NULL');
//        dd($query);

        if ($request->filled('room_address')) {
            $query->where('ua_address', 'like', '%' . $request->room_address . '%');
        }
        if ($request->filled('room_price')) {
            $query->where('ua_rent_fees', '<=', $request->room_price);
        }
        if ($request->filled('room_size')) {
            $query->where('ua_size', '>=', $request->room_size);
        }
        if ($request->filled('room_type')) {
            $query->where('ua_type', $request->room_type);
        }
        if ($request->filled('room_gender_pref')) {
            // Assuming a custom field or logic for gender preference; adjust as needed
        }
        if ($request->filled('room_pets_allowed')) {
            $query->where('ua_pets_allowed', $request->room_pets_allowed === 'Yes' ? 'Yes' : 'No');
        }
        if ($request->filled('room_smoking_allowed')) {
            $query->where('ua_smoking_allowed', $request->room_smoking_allowed === 'Yes' ? 'Yes' : 'No');
        }
        if ($request->filled('room_numofroommates')) {
            $query->where('ua_num_of_roommates', '<=', $request->room_numofroommates);
        }
        if ($request->filled('room_lease_term')) {
            $query->where('ua_lease_term', '<=', $request->room_lease_term);
        }

        $unitAds = $query->paginate(9);
        return view('website.units', compact('unitAds'));
    }
    public function unitAdSingle($id)
    {
        $unitAd = UnitAds::with(['images', 'facilities', 'reviews.account'])->findOrFail($id);
        $alreadyViewed = View::where('ua_id', $unitAd->ua_id)
            ->where(function($q) {
                if (auth()->check()) {
                    $q->where('acc_id', auth()->id());
                } else {
                    $q->where('view_ip_address', request()->ip());
                }
            })
            ->whereDate('view_dateTime', now()->toDateString())
            ->exists();
        dd($alreadyViewed);
        if (!$alreadyViewed) {
            View::create([
                'ua_id' => $unitAd->ua_id,
                'acc_id' => auth()->id(),
                'view_ip_address' => request()->ip(),
                'view_dateTime' => now(),
            ]);
        }

        return view('website.unit_ad_single', compact('unitAd'));
    }

    public function services()
    {
        return view('website.services');
    }

    public function packages()
    {
        $packages = Package::all();
        return view('website.packages', compact('packages'));
    }

    public function findRoommates()
    {
        return view('website.request_roommate');
    }
}
