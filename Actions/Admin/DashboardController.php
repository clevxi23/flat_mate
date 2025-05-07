<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facilities;
use App\Models\Like;
use App\Models\Message;
use App\Models\Package;
use App\Models\Subscribtion;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Account;
use App\Models\UnitAds;
use App\Models\RoommateRequest;
use App\Models\Review;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{

    public function index()
    {
        $totalUsers = Account::count();
        $totalListings = UnitAds::count();
        $totalReports = RoommateRequest::count();
        $totalR = Review::count();
        $totalLikes = Like::count();
        $totalViews = View::count();
        $totalPackages = Package::count();
        $mes = Message::count();

        $monthlyUnits = UnitAds::selectRaw('MONTH(ua_added_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $subscriptionsPerPackage = Subscribtion::selectRaw('pack_id, COUNT(*) as total')
            ->groupBy('pack_id')
            ->pluck('total', 'pack_id');

        $packageLabels = Package::whereIn('pack_id', $subscriptionsPerPackage->keys())
            ->pluck('pack_name', 'pack_id');

        $recentRequests = RoommateRequest::with('account')
            ->latest('roommate_req_id')
            ->take(5)
            ->get();

        $topReviews = Review::with('account')
            ->orderBy('review_rate', 'desc')
            ->take(5)
            ->get();

        return view('website.admin.dashboard', compact(
            'totalUsers',
            'totalListings',
            'totalReports',
            'totalR',
            'mes',
            'totalLikes',
            'totalViews',
            'totalPackages',
            'monthlyUnits',
            'subscriptionsPerPackage',
            'packageLabels',
            'recentRequests',
            'topReviews'
        ));
    }



    public function profile()
    {
        $account = Auth::user();
        return view('website.admin.profile', compact('account'));
    }

    public function updateProfile(Request $request)
    {
        $account = Auth::user();

        $request->validate([
            'acc_name' => 'required|string|max:100',
            'acc_email' => 'required|email|max:255|unique:ACCOUNT,acc_email,' . $account->acc_id . ',acc_id',
            'acc_phone' => ['required', 'numeric', 'regex:/^(05\d{8}|\+9665\d{8})$/'],
            'acc_address' => 'nullable|string|max:255',
        ]);

        $account->update([
            'acc_name' => $request->acc_name,
            'acc_email' => $request->acc_email,
            'acc_phone' => $request->acc_phone,
            'acc_address' => $request->acc_address,
        ]);

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $account = Auth::user();
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z0-9]).+$/'
            ],
        ]);
        if (!Hash::check($request->current_password, $account->acc_password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }
        $account->update([
            'acc_password' => Hash::make($request->new_password),
        ]);
        return redirect()->route('admin.profile')->with('success', 'Password changed successfully.');
    }
}
