<?php

namespace App\Http\Controllers\HouseOwner;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\RoommateRequest;
use App\Models\Subscribtion;
use App\Models\UnitAds;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HouseOwnerController extends Controller
{
    public function dashboard()
    {
        $account = Auth::user();

        $subscription = $account->subscriptions()->first();

        $totalUnitAds = $account->unitAds()->count();
        $availableUnitAds = $account->unitAds()->where('ua_status', '<=', 'Available')->count();
        $bookedUnitAds = $account->unitAds()->where('ua_status', 'Booked')->count();
        $closedUnitAds = $account->unitAds()->where('ua_status', 'Closed')->count();

        // Messages
        $unreadMessagesCount = $account->receivedMessages()->where('is_read', 0)->count();

        // Reviews
        $totalReviews = $account->unitAds()->withCount('reviews')->get()->sum('reviews_count');

        $monthlyRevenue = $account->unitAds()
            ->selectRaw('MONTH(ua_availability_start_date) as month, SUM(ua_rent_fees) as revenue')
            ->groupBy('month')
            ->pluck('revenue', 'month')
            ->mapWithKeys(fn($value, $key) => [date('M', mktime(0, 0, 0, $key, 1)) => $value])
            ->toArray();
        $totalLikes = $account->unitAds()->withCount('likes')->get()->sum('likes_count');

        $totalViews = $account->unitAds()->withCount('views')->get()->sum('views_count');

        $allowedAds = optional($subscription)->sub_number_of_ads ?? 0;
        $remainingAds = max($allowedAds - $totalUnitAds, 0);
        return view('website.owner.dashboard', compact(
            'account',
            'subscription',
            'totalUnitAds',
            'availableUnitAds',
            'unreadMessagesCount',
            'totalReviews',
            'bookedUnitAds',
            'closedUnitAds',
            'totalViews',
            'remainingAds',
            'totalLikes',
            'monthlyRevenue'
        ));
    }

    public function subscribe(Request $request)
    {
        $account = Auth::user();
        $packageId = $request->get('package', 1);
        $package = Package::findOrFail($packageId);
        $packages = Package::where('pack_status', 'active')->get();
        $currentSubscription = $account->subscriptions()->first();
        if ($currentSubscription && $currentSubscription->sub_end_date > now()) {
            return back()->with('warning', 'You already have an active subscription.');
        }

        return view('website.owner.subscribe', compact('package', 'packages'));
    }


    public function storeSubscription(Request $request)
    {
        $account = Auth::user();
        $package = Package::find(1);
        $request->validate([
            'card_number' => 'required|numeric|digits:16',
            'cardholder_name' => 'required|string|max:100',
            'expiry_date' => 'required|date_format:m/y|after:now',
            'cvv' => 'required|numeric|digits:3',
        ]);
        try {
            $startDate = Carbon::now();
            $endDate = $startDate->copy()->addMonths(12);
            Subscribtion::create([
                'sub_amount' => $package->pack_fee,
                'sub_start_date' => $startDate,
                'sub_end_date' => $endDate,
                'sub_number_of_ads' => 100,
                'sub_payment_method' => 'Credit Card',
                'sub_card_number' => substr($request->card_number, -4),
                'acc_id' => $account->acc_id,
                'pack_id' => $package->pack_id,
            ]);
            return redirect()->route('owner.dashboard')->with('success', 'Subscription activated successfully! Payment of ' . $package->pack_fee . ' SAR was processed.');
        } catch (\Exception $e) {
            return back()->withErrors(['payment' => 'Payment failed: ' . $e->getMessage()]);
        }
    }

    public function profile()
    {
        $account = Auth::user();
        return view('website.owner.profile', compact('account'));
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

        return redirect()->route('owner.profile')->with('success', 'Profile updated successfully.');
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
        return redirect()->route('owner.profile')->with('success', 'Password changed successfully.');
    }
}
