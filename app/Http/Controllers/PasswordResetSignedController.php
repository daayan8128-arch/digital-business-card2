<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendResetLinkMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PasswordResetSignedController extends Controller
{
    public function showRequestForm()
    {
        return view('filament.passwords.request'); // same simple blade
    }

    public function sendSignedLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return back()->withErrors(['email' => 'Email not found in our records.']);
        }

        // Create a temporary signed URL that expires in 15 minutes
        $signedUrl = URL::temporarySignedRoute(
            'filament.password.reset.form',
            now()->addMinutes(15),
            ['email' => $request->email, 'nonce' => Str::random(40)]
        );

        // Send email containing the signed link
        Mail::to($request->email)->send(new SendResetLinkMail($signedUrl, $user));

        return back()->with('message', 'Reset link sent to your Gmail. Please check your inbox.');
    }

    public function showResetForm(Request $request)
    {
        // Validate signature (and email param present)
        if (! $request->hasValidSignature()) {
            abort(403, 'Invalid or expired link.');
        }

        // Optionally, re-check that email exists
        $email = $request->query('email');
        $user = User::where('email', $email)->first();
        if (! $user) {
            abort(404, 'User not found.');
        }

        // Show password reset form — include hidden fields for email and the signature params
        return view('filament.passwords.reset', ['email' => $email]);
    }

    public function resetPassword(Request $request)
    {
        // Validate signature again to avoid tampering when form posted
        if (! $request->hasValidSignature()) {
            abort(403, 'Invalid or expired link.');
        }

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->firstOrFail();
        $user->password = Hash::make($request->password);
        $user->setRememberToken(Str::random(60));
        $user->save();

        return redirect()->route('filament.auth.login')->with('message', 'Password changed. Please login.');
    }
}
