<?php

namespace App\Http\Controllers\HouseOwner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RoommateRequest;
use App\Models\UnitAds;

class RoommateRequestController extends Controller
{
    public function index()
    {
        $unitIds = UnitAds::where('acc_id', Auth::id())->pluck('ua_id');
        $requests = RoommateRequest::whereIn('ua_id', $unitIds)->with(['account', 'unitAd'])->get();

        return view('website.owner.requests.index', compact('requests'));
    }

    public function updateOwnerAction(Request $request, $id)
    {
        $request->validate([
            'action' => 'required|in:pending,accepted,rejected,invited',
        ]);

        $requestModel = RoommateRequest::whereHas('unitAd', function ($q) {
            $q->where('acc_id', Auth::id());
        })->findOrFail($id);

        $requestModel->update(['owner_action' => $request->action]);

        return redirect()->back()->with('success', 'Action updated successfully.');
    }

    public function show($id)
    {
        $request = RoommateRequest::with(['account', 'unitAd'])
            ->whereHas('unitAd', fn($q) => $q->where('acc_id', Auth::id()))
            ->findOrFail($id);

        return view('website.owner.requests.show', compact('request'));
    }


}
