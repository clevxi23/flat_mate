<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Account;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'acc_name'     => 'required|string|max:100',
            'acc_middle_name' => 'nullable|string|max:100',
            'acc_tribe_name'   => 'nullable|string|max:100',

            'acc_email'    => 'required|email|unique:ACCOUNT,acc_email',
            'acc_phone'    => ['required', 'numeric','regex:/^(05\d{8}|\+9665\d{8})$/'],
            'acc_password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z0-9]).+$/'
            ],
            'acc_address'  => 'nullable|string|max:255',
            'acc_gender'   => 'nullable|in:Male,Female',
            'acc_type'     => 'required|in:house_owner,roommate',
            'acc_age'      => 'nullable|integer|min:18|max:100',
            'acc_smoking'  => 'nullable|in:0,1',
            'acc_status'   => 'nullable|string|max:255',

        ], [
            'acc_phone.regex' => 'Phone must start with 05 or +9665 followed by 8 digits.',
            'acc_password.regex' => 'Password must contain letters, digits, and symbols.',
        ]);

        $account = Account::create([
            'acc_name' => $request->acc_name,
            'acc_email' => $request->acc_email,
            'acc_phone' => $request->acc_phone,
            'acc_password' => Hash::make($request->acc_password),
            'acc_gender' => $request->acc_gender,
            'acc_address' => $request->acc_address,
            'acc_type' => $request->acc_type,
            'acc_point' => 0,
            'acc_total_count' => 0,
            'acc_age'     => $request->acc_age,
            'acc_smoking' => $request->acc_smoking,
            'acc_status'  => $request->acc_status,
            'acc_middle_name'  => $request->acc_middle_name,
            'acc_tribe_name'  => $request->acc_tribe_name,

        ]);

        return redirect()->route('website.login')->with('success', ucfirst($request->acc_type) . ' registered successfully. Please login.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'role' => 'required|in:admin,roommate,house_owner',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = Account::where('acc_email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->acc_password) && $user->acc_type === $request->role) {
            Auth::login($user);
            if ($user->acc_type === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->acc_type === 'house_owner') {
                return redirect()->route('owner.dashboard');
            } else {
                return redirect()->route('roommate.profile');
            }
        }

        return back()->with(['error' => 'Invalid credentials or role selection.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('website.login')->with('status', 'Logged out successfully.');
    }

    public function simulateNafath()
    {
        return view('website.auth.simulate_nafath');
    }

    public function submitSimulatedNafath(Request $request)
    {
        $code = rand(10, 99);
        return view('website.auth.nafath_confirm', compact('code'));
    }

}
