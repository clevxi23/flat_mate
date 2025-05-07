<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Like;
use App\Models\RoommateRequest;
use App\Models\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Models\UnitAds;
use App\Models\Message;
use App\Models\Review;

class RoommateController extends Controller
{
    public function showUnitAd($id)
    {
        $unitAd = UnitAds::with(['images', 'facilities', 'reviews.account', 'account'])->findOrFail($id);
        $alreadyViewed = View::where('ua_id', $unitAd->ua_id)
            ->where(function ($q) {
                if (auth()->check()) {
                    $q->where('acc_id', auth()->id());
                } else {
                    $q->where('view_ip_address', request()->ip());
                }
            })
            ->whereDate('view_dateTime', now()->toDateString())
            ->exists();
        if (!$alreadyViewed) {
            View::create([
                'ua_id' => $unitAd->ua_id,
                'acc_id' => auth()->id(),
                'view_ip_address' => request()->ip(),
                'view_dateTime' => now(),
            ]);
        }
        $messages = Message::where(function ($query) use ($unitAd) {
            $query->where(function ($q) use ($unitAd) {
                $q->where('sender_id', Auth::id())
                    ->where('receiver_id', $unitAd->acc_id);
            })->orWhere(function ($q) use ($unitAd) {
                $q->where('sender_id', $unitAd->acc_id)
                    ->where('receiver_id', Auth::id());
            });
        })->with(['sender', 'receiver'])
            ->orderBy('ma_date_time', 'asc')
            ->get();
        return view('website.unit_ad_single', compact('unitAd', 'messages'));
    }

    public function sendMessage(Request $request, $cssID)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);
        $message = Message::create([
            'ma_title' => 'Chat about Unit Ad #',
            'ma_type' => 'unit_ad_chat',
            'ma_date_time' => now(),
            'ma_content' => $request->message,
            'sender_id' => Auth::id(),
            'receiver_id' => $cssID,
        ]);
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => [
                    'content' => $message->ma_content,
                    'sender' => $message->sender->acc_name,
                    'date_time' => $message->ma_date_time->format('Y-m-d H:i A'),
                    'is_sender' => $message->sender_id == Auth::id(),
                ]
            ]);
        }
        return back()->with('success', 'Message sent successfully!');
    }

    public function storeReview(Request $request, $unitAdId)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
            'rating' => 'required|integer|between:1,5',
        ]);
        $unitAd = UnitAds::findOrFail($unitAdId);
        Review::create([
            'review_comment' => $request->comment,
            'review_rate' => $request->rating,
            'acc_id' => Auth::id(),
            'review_dateTime' => now(),
            'ua_id' => $unitAd->ua_id,
        ]);
        $user = Auth::user();
        $user->increment('acc_point', 5);
        return redirect()->back()->with('success', 'Review added successfully! You earned 5 points.');
    }

    public function deleteReview($reviewId)
    {
        $review = Review::findOrFail($reviewId);
        if ($review->acc_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to delete this review.');
        }
        $user = Auth::user();
        $user->decrement('acc_point', 5);
        $review->delete();
        return redirect()->back()->with('success', 'Review deleted successfully! 5 points have been deducted.');
    }

    public function profile()
    {
        $user = Auth::user();
        $reviews = Review::with('unitAds')
            ->where('acc_id', Auth::id())
            ->get();
        $totalPoints = Auth::user()->acc_point;
        return view('website.roommate.profile', compact('user','reviews', 'totalPoints'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'acc_middle_name' => 'nullable|string|max:100',
            'acc_tribe_name'   => 'nullable|string|max:100',

            'acc_name' => 'required|string|max:100|regex:/^[a-zA-Z\s]+$/',
            'acc_email' => 'required|string|email|max:255|unique:ACCOUNT,acc_email,' . $user->acc_id . ',acc_id',
            'acc_phone' => ['required', 'numeric', 'regex:/^(05\d{8}|\+9665\d{8})$/'],
            'acc_gender' => 'required|in:Male,Female',
            'acc_address' => 'required|string|max:255',
            'acc_password' => 'nullable|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'acc_age' => 'nullable|integer|min:18|max:100',
            'acc_smoking' => 'nullable|in:0,1',
            'acc_status' => 'nullable|string|max:255',

        ], [
            'acc_name.regex' => 'Name must contain only letters and spaces.',
            'acc_phone.regex' => 'Phone must start with 05 or +9665 followed by 8 digits.',
            'acc_password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, and one number.',
            'acc_gender.in' => 'Gender must be either Male or Female.',
        ]);
        $user->update([
            'acc_name' => $request->acc_name,
            'acc_email' => $request->acc_email,
            'acc_phone' => $request->acc_phone,
            'acc_gender' => $request->acc_gender,
            'acc_address' => $request->acc_address,
            'acc_age' => $request->acc_age,
            'acc_smoking' => $request->acc_smoking,
            'acc_status' => $request->acc_status,
            'acc_middle_name' => $request->acc_middle_name,
            'acc_tribe_name' => $request->acc_tribe_name,
            'acc_password' => $request->filled('acc_password') ? Hash::make($request->acc_password) : $user->acc_password,
        ]);

        return redirect()->route('roommate.profile')->with('success', 'Profile updated successfully!');
    }

    public function createRoommateRequest($unitAdId)
    {
        $unitAd = UnitAds::findOrFail($unitAdId);
        return view('website.roommate.create_roommate_request', compact('unitAd'));
    }

    public function storeRoommateRequest(Request $request, $unitAdId)
    {
        $unitAd = UnitAds::findOrFail($unitAdId);
        $request->validate([
            'roommate_req_des' => 'required|string|max:500',
            'roommate_req_gender' => 'required|in:Male,Female',
            'roommate_req_age' => 'required|string|max:50',
            'roommate_req_emp_status' => 'required|in:Employed,Student,Unemployed',
            'roommate_req_smoking' => 'required|in:1,0',
            'roommate_req_child' => 'required|in:1,0',
            'roommate_req_pets_ref' => 'required|in:1,0',
            'roommate_req_num_of_roommate' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) use ($unitAd) {
                    if ($value > $unitAd->ua_num_of_roommates) {
                        $fail("The number of roommates cannot exceed {$unitAd->ua_num_of_roommates}.");
                    }
                },
            ],
        ]);
        RoommateRequest::create([
            'acc_id' => Auth::id(),
            'ua_id' => $unitAd->ua_id,
            'roommate_req_des' => $request->roommate_req_des,
            'roommate_req_gender' => $request->roommate_req_gender,
            'roommate_req_age' => $request->roommate_req_age,
            'roommate_req_emp_status' => $request->roommate_req_emp_status,
            'roommate_req_smoking' => $request->roommate_req_smoking,
            'roommate_req_child' => $request->roommate_req_child,
            'roommate_req_pets_ref' => $request->roommate_req_pets_ref,
            'roommate_req_num_of_roommate' => $request->roommate_req_num_of_roommate,
        ]);
        return redirect()->route('roommate.requests')->with('success', 'Roommate request created successfully!');
    }


    public function listRoommateRequests(Request $request)
    {
        $query = RoommateRequest::with('unitAd', 'account')
            ->where('req_status', 'Open')
            ->whereHas('unitAd', function ($q) {
                $q->where('ua_status', 'Available');
            })
            ->whereRaw('(SELECT COUNT(*) FROM APPLICATION WHERE APPLICATION.roommate_req_id = ROOMMATEREQUEST.roommate_req_id AND APPLICATION.app_status = "accepted")
            < ROOMMATEREQUEST.roommate_req_num_of_roommate');

        if ($request->filled('gender')) {
            $query->where('roommate_req_gender', $request->gender);
        }

        if ($request->filled('age')) {
            $query->where('roommate_req_age', 'like', '%' . $request->age . '%');
        }

        if ($request->filled('employment')) {
            $query->where('roommate_req_emp_status', 'like', '%' . $request->employment . '%');
        }

        if ($request->filled('smoking')) {
            $query->where('roommate_req_smoking', $request->smoking);
        }

        if ($request->filled('child')) {
            $query->where('roommate_req_child', 'like', '%' . $request->child . '%');
        }

        if ($request->filled('pets')) {
            $query->where('roommate_req_pets_ref', $request->pets);
        }

        if ($request->filled('address')) {
            $query->whereHas('unitAd', function ($q) use ($request) {
                $q->where('ua_address', 'like', '%' . $request->address . '%');
            });
        }

        $requests = $query->get();

        return view('website.roommate.join_roommate_request', compact('requests'));
    }

    public function showRoommateRequest($id)
    {
        $request = RoommateRequest::with('unitAd', 'account')->findOrFail($id);
        $messages = Message::where(function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('sender_id', Auth::id())
                    ->where('receiver_id', $request->acc_id);
            })->orWhere(function ($q) use ($request) {
                $q->where('sender_id', $request->acc_id)
                    ->where('receiver_id', Auth::id());
            });
        })->with(['sender', 'receiver'])->orderBy('ma_date_time', 'asc')->get();
        $unitAd = $request->unitAd;
        return view('website.roommate.roommate_request_details', compact('request', 'messages', 'unitAd'));
    }



    public function joinRoommateRequest(Request $request, $id)
    {
        $roommateRequest = RoommateRequest::withCount(['applications' => function ($query) {
            $query->where('app_status', 'accepted');
        }])->findOrFail($id);
        if ($roommateRequest->unitAd->ua_status !== 'Available') {
            return redirect()->back()->with('error', 'This unit is no longer available.');
        }
        if ($roommateRequest->req_status !== 'Open' || $roommateRequest->applications_count >= $roommateRequest->roommate_req_num_of_roommate) {
            return redirect()->back()->with('error', 'This roommate request is already completed.');
        }
        $existingApplication = Application::where('acc_id', Auth::id())
            ->where('roommate_req_id', $id)
            ->exists();
        if ($existingApplication) {
            return redirect()->back()->with('error', 'You have already applied to this request.');
        }
        Application::create([
            'app_status' => 'pending',
            'acc_id' => Auth::id(),
            'roommate_req_id' => $roommateRequest->roommate_req_id,
        ]);
        return redirect()->back()->with('success', 'Application submitted successfully!');
    }

    public function updateRequestStatus($roommateRequestId)
    {
        $request = RoommateRequest::withCount(['applications' => function ($query) {
            $query->where('app_status', 'accepted');
        }])->findOrFail($roommateRequestId);
        if ($request->applications_count >= $request->roommate_req_num_of_roommate) {
            $request->update(['req_status' => 'Completed']);
            $request->unitAd->update(['ua_status' => 'Booked']);
        }
    }


    public function myRoommateRequests()
    {
        $requests = RoommateRequest::with(['unitAd', 'applications.account'])->where('acc_id', Auth::id())->get();
        return view('website.roommate.roommate_requests', compact('requests'));
    }

    public function acceptApplication(Request $request, $applicationId): RedirectResponse
    {
        $application = Application::findOrFail($applicationId);
        $roommateRequest = RoommateRequest::findOrFail($application->roommate_req_id);
        if ($roommateRequest->acc_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to perform this action.');
        }
        $application->update(['app_status' => 'accepted']);
        $acceptedCount = $roommateRequest->applications()->where('app_status', 'accepted')->count();
//        dd($acceptedCount,$roommateRequest, $acceptedCount >= $roommateRequest->roommate_req_num_of_roommate);
        if ($acceptedCount >= $roommateRequest->roommate_req_num_of_roommate) {
            $roommateRequest->update(['req_status' => 'Completed']);
            $roommateRequest->unitAd->update(['ua_status' => 'Booked']);
        }
        return redirect()->back()->with('success', 'Application accepted successfully!');
    }

    public function rejectApplication(Request $request, $applicationId): RedirectResponse
    {
        $application = Application::findOrFail($applicationId);
        $roommateRequest = RoommateRequest::findOrFail($application->roommate_req_id);
        if ($roommateRequest->acc_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to perform this action.');
        }
        $application->update(['app_status' => 'rejected']);
        return redirect()->back()->with('success', 'Application rejected successfully!');
    }

    public function listApplications(int $id)
    {
        $req = RoommateRequest::findOrFail($id);
        $applications = Application::with(['roommateRequest.unitAd', 'account'])
            ->where('roommate_req_id', $id)
            ->whereHas('roommateRequest', function ($query) {$query->where('acc_id', Auth::id());})->get();
        return view('website.roommate.applications_list', compact('applications', 'req'));
    }

    public function earnings()
    {
        $reviews = Review::with('unitAds')
            ->where('acc_id', Auth::id())
            ->get();
        $totalPoints = Auth::user()->acc_point;
        return view('website.roommate.earnings', compact('reviews', 'totalPoints'));
    }

    public function points()
    {
        $reviews = Review::with('unitAds')
            ->where('acc_id', Auth::id())
            ->get();
        $totalPoints = Auth::user()->acc_point;
        return view('website.roommate.points', compact('reviews', 'totalPoints'));
    }

    public function myApplications()
    {
        $applications = Application::with(['roommateRequest.unitAd', 'account'])
            ->where('acc_id', Auth::id())
            ->get();
        return view('website.roommate.my_applications', compact('applications'));
    }

    public function deleteApplication($applicationId)
    {
        $application = Application::findOrFail($applicationId);

        // Check if the application belongs to the authenticated user
        if ($application->acc_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to delete this application.');
        }

        $application->delete();

        return redirect()->back()->with('success', 'Application deleted successfully!');
    }
    public function toggleLike($unitAdId)
    {
        $userId = auth()->id();

        $like = Like::where('ua_id', $unitAdId)
            ->where('acc_id', $userId)
            ->first();

        if ($like) {
            $like->delete();
            return redirect()->back()->with('success', 'Removed from liked units.');
        } else {
            Like::create([
                'ua_id' => $unitAdId,
                'acc_id' => $userId,
                'like_dateTime' => now(),
            ]);
            return redirect()->back()->with('success', 'Added to liked units.');
        }
    }

    public function likes()
    {
        $likes = Like::where('acc_id', auth()->id())->with('unitAd')->get();
        return view('website.roommate.likes', compact('likes'));
    }


}
