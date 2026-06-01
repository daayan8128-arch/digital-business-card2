<?php

namespace App\Http\Controllers;

use App\Mail\SendOtpMail;
use App\Models\User;
use App\Models\Otp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    // Show forgot form
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    // Step 1: Send OTP
    public function requestOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return back()->with('error', 'Email not found!');
        }

        // Generate 6-digit OTP
        $otpPlain = random_int(100000, 999999);

        // Save hashed OTP in separate table (update or create)
        Otp::updateOrCreate(
            ['email' => $user->email],
            [
                'user_id'    => $user->id,
                'otp'        => Hash::make((string) $otpPlain),
                'expires_at' => now()->addMinutes(10),
            ]
        );

        // Send OTP email (your existing Mailable)
        Mail::to($user->email)->send(new SendOtpMail($otpPlain));

        // Return back and show OTP fields (we set session email so OTP form can use it)
        return back()->with([
            'success' => 'OTP sent to your email!',
            'showOtpForm' => true,
            'email' => $user->email,
            'otp_length' => 6,
        ]);
    }

    // Step 2: Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp'   => 'required',
        ]);

        $otpEntry = Otp::where('email', $request->email)->first();

        if (! $otpEntry) {
            return back()->with('error', 'Invalid or expired OTP!')->withInput();
        }

        // check expiry
        if ($otpEntry->expires_at->lt(now())) {
            // expired → delete entry
            $otpEntry->delete();
            return back()->with('error', 'OTP expired! Please request a new one.');
        }

        // check OTP (we stored hashed)
        if (! Hash::check((string) $request->otp, $otpEntry->otp)) {
            return back()->with('error', 'Invalid OTP!')->withInput();
        }

        // OTP valid — remove it so it can't be reused
        $otpEntry->delete();

        // redirect to reset form with email in session
        return redirect()->route('reset-password.show')->with('email', $request->email);
    }

    // Step 3: Show reset form
    public function showResetForm(Request $request)
    {
        $email = session('email'); // carried via verifyOtp
        if (! $email) {
            return redirect()->route('forgot-password.show')->with('error', 'Session expired!');
        }
        return view('auth.reset-password', compact('email'));
    }

    // Step 4: Update password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();
        if (! $user) {
            return redirect()->route('forgot-password.show')->with('error', 'Email not found!');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // cleanup any OTPs for this email
        Otp::where('email', $request->email)->delete();

        return redirect('/login')->with('success', 'Password reset successfully!');
    }
}
