<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Account;
use App\Models\UnitAds;
use App\Models\RoommateRequest;
use App\Models\Review;
use App\Models\Facilities;
use App\Models\Subscribtion;

class ReportController extends Controller
{
    public function index()
    {
        // Popular Units
        $popularUnits = UnitAds::with('account')
            ->withCount('roommateRequests')
            ->orderByDesc('roommate_requests_count')
            ->take(5)
            ->get();

        // Top Rated Users (Roommate & House Owner)
        $topRatedUsers = Account::withCount(['reviews'])
            ->with(['reviews'])
            ->get()
            ->map(function ($user) {
                $user->avg_rating = $user->reviews->avg('review_rate');
                return $user;
            })->sortByDesc('avg_rating')->take(5);

        // Most Used Facilities
        $facilityStats = Facilities::select('fac_title', DB::raw('COUNT(*) as total'))
            ->groupBy('fac_title')
            ->orderByDesc('total')
            ->get();

        // Subscription Conversion
        $totalOwners = Account::where('acc_type', 'house_owner')->count();
        $subscribedOwners = Subscribtion::distinct('acc_id')->count('acc_id');
        $subscriptionConversionRate = $totalOwners > 0 ? round(($subscribedOwners / $totalOwners) * 100, 2) : 0;

        $avgRatings = Review::with('unitAds')
            ->select('ua_id', DB::raw('AVG(review_rate) as avg_rating'))
            ->groupBy('ua_id')
            ->get()
            ->map(function ($review) {
                $review->ua_address = optional($review->unitAds)->ua_address ?? 'Unknown';
                return $review;
            });

        return view('website.admin.reports', compact(
            'popularUnits',
            'topRatedUsers',
            'facilityStats',
            'totalOwners',
            'subscribedOwners',
            'subscriptionConversionRate',
            'avgRatings'
        ));
    }
}
