<?php

namespace App\Http\Controllers\HouseOwner;

use App\Http\Controllers\Controller;
use App\Models\RoommateRequest;
use App\Models\Subscribtion;
use App\Models\UnitAds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        return view('website.owner.reports.index');
    }

    public function unitAdsReport()
    {
        $ads = UnitAds::withCount([
            'facilities',
            'images',
            'likes',
            'views',
        ])
            ->withAvg('reviews', 'review_rate')
            ->with(['roommateRequests' => function ($q) {
                $q->select('ua_id', 'owner_action');
            }])
            ->where('acc_id', Auth::id())
            ->get();

        return view('website.owner.reports.unit_ads', compact('ads'));
    }


    public function roommateRequestsReport()
    {
        $unitIds = UnitAds::where('acc_id', Auth::id())->pluck('ua_id');
        $requests = RoommateRequest::whereIn('ua_id', $unitIds)->with('account', 'unitAd')->get();

        return view('website.owner.reports.roommate_requests', compact('requests'));
    }

    public function subscriptionUsageReport()
    {
        $subscription = Subscribtion::where('acc_id', Auth::id())
            ->where('sub_end_date', '>', now())
            ->latest('sub_start_date')
            ->first();

        $totalAdsPosted = UnitAds::where('acc_id', Auth::id())->count();

        return view('website.owner.reports.subscription_usage', compact('subscription', 'totalAdsPosted'));
    }
}
