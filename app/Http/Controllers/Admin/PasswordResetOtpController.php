<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendOtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetOtpController extends Controller
{
    public function showEmailForm()
    {
        return view('filament.passwords.request');
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return back()->withErrors(['email' => 'Email not found']);
        }

        $otp = random_int(100000, 999999);

        // OTP ko cache me rakho (10 min ke liye)
        Cache::put('otp_' . $user->email, Hash::make($otp), now()->addMinutes(10));

        // OTP email bhejo
        Mail::to($user->email)->send(new SendOtpMail($otp));

        return redirect()->route('filament.password.otpForm', ['email' => $user->email])
                         ->with('message', 'OTP sent to your Gmail');
    }

    public function showOtpForm(Request $request)
    {
        $email = $request->query('email');
        return view('filament.passwords.verify', compact('email'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp'   => 'required'
        ]);

        $hashedOtp = Cache::get('otp_' . $request->email);

        if (! $hashedOtp || ! Hash::check($request->otp, $hashedOtp)) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP']);
        }

        // OTP verified → allow password reset
        session(['otp_verified' => true, 'reset_email' => $request->email]);

        return redirect()->route('filament.password.resetForm');
    }

    public function showResetForm()
    {
        if (! session('otp_verified')) {
            return redirect()->route('filament.password.email')->withErrors(['otp' => 'OTP required']);
        }
        return view('filament.passwords.reset');
    }

    public function resetPassword(Request $request)
    {
        if (! session('otp_verified') || ! session('reset_email')) {
            return redirect()->route('filament.password.email')->withErrors(['otp' => 'OTP required']);
        }

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('email', session('reset_email'))->firstOrFail();
        $user->password = Hash::make($request->password);
        $user->setRememberToken(Str::random(60));
        $user->save();

        // cleanup
        Cache::forget('otp_' . $user->email);
        session()->forget(['otp_verified', 'reset_email']);

        return redirect()->route('filament.auth.login')->with('message', 'Password changed successfully');
    }
}
