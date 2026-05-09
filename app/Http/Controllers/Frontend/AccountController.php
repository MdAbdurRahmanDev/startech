<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Order;
use App\Models\RefundRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('user.account');
        }
        return view('frontend.account.login');
    }

    public function storeLogin(Request $request)
    {
        $request->validate([
            'login_identity' => 'required|string',
            'password' => 'required|string',
        ]);

        $identity = $request->login_identity;
        $fieldType = filter_var($identity, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if (Auth::attempt([$fieldType => $identity, 'password' => $request->password], $request->has('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/account/account')->with('success', 'Logged in successfully.');
        }

        return back()->withErrors([
            'login_identity' => 'The provided credentials do not match our records.',
        ])->onlyInput('login_identity');
    }

    public function register()
    {
        if (Auth::check()) {
            return redirect()->route('user.account');
        }
        return view('frontend.account.register');
    }

    public function storeRegister(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'telephone' => 'required|string|max:20|unique:users,phone',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'phone' => $request->telephone,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('user.account')->with('success', 'Registration successful!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Logged out successfully.');
    }

    public function account()
    {
        return view('frontend.account.account');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('frontend.account.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'telephone' => 'required|string|max:20|unique:users,phone,' . $user->id,
        ]);

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'phone' => $request->telephone,
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'The old password does not match.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password changed successfully.');
    }

    public function order()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->paginate(10);
        return view('frontend.account.order', compact('orders'));
    }

    public function showRefundForm($order_id)
    {
        $order = Order::where('user_id', Auth::id())->where('id', $order_id)->firstOrFail();
        if ($order->refundRequest) {
            return back()->with('error', 'Refund request already submitted for this order.');
        }
        return view('frontend.account.refund', compact('order'));
    }

    public function storeRefund(Request $request, $order_id)
    {
        $order = Order::where('user_id', Auth::id())->where('id', $order_id)->firstOrFail();
        
        $request->validate([
            'reason' => 'required|string|min:10',
        ]);

        RefundRequest::create([
            'order_id' => $order->id,
            'user_id' => Auth::id(),
            'reason' => $request->reason,
            'amount' => $order->total,
            'status' => 'pending',
        ]);

        return redirect()->route('user.order')->with('success', 'Refund request submitted successfully!');
    }

    public function address()
    {
        $user = Auth::user();
        return view('frontend.account.address', compact('user'));
    }

    public function updateAddress(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:500',
            'upazila' => 'required|string|max:255',
            'district' => 'required|string|max:255',
        ]);

        Auth::user()->update([
            'address' => $request->address,
            'upazila' => $request->upazila,
            'district' => $request->district,
        ]);

        return back()->with('success', 'Address updated successfully.');
    }
}
