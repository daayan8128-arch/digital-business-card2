<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordResetController extends Controller
{
    // Step 1: Show Forgot Form
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    // Step 2: Send OTP
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return back()->withErrors(['email' => 'Email not found in our records.']);
        }

        // Generate OTP (6 digit)
        $otp = rand(100000, 999999);

        // Store OTP & email in session (not in DB)
        session([
            'otp' => $otp,
            'email' => $user->email,
        ]);

        // Send OTP by email
        try {
            Mail::raw("Your OTP for password reset is: $otp", function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Password Reset OTP');
            });
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Failed to send OTP. Please try again.']);
        }

        return redirect()->route('otp.verify')->with('success', 'OTP sent to your email.');
    }

    // Step 3: Show OTP Form
    public function showOtpForm()
    {
        return view('auth.verify-otp');
    }

    // Step 4: Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        if ($request->otp == session('otp')) {
            // OTP correct → move to reset password form
            return redirect()->route('password.reset.form');
        }

        return back()->withErrors(['otp' => 'Invalid OTP']);
    }

    // Step 5: Show Reset Password Form
    public function showResetForm()
    {
        // Security: check if email & otp exist in session
        if (! session()->has('email') || ! session()->has('otp')) {
            return redirect()->route('forgot-password')->withErrors(['email' => 'Session expired. Please try again.']);
        }

        return view('auth.reset-password');
    }

    // Step 6: Reset Password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::where('email', session('email'))->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        // Clear session after success
        session()->forget(['otp', 'email']);

        return redirect()->route('filament.auth.login')->with('success', 'Password reset successfully. Please login.');
    }
}
