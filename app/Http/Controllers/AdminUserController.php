<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminUserController extends Controller
{
    public function createPremiumUser(Request $request)
    {
        $admin = auth()->user();

        if (!$admin->isAdmin()) {
            return back()->with('error', 'Only admins can create premium users');
        }

        if ($admin->subscription_count <= 0) {
            return back()->with('error', 'No subscriptions left');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_premium' => 1,
            'premium_start_date' => Carbon::now(),
            'premium_end_date' => Carbon::now()->addYear(),
        ]);

        // Deduct one subscription from admin
        $admin->subscription_count -= 1;
        $admin->save();

        return back()->with('success', 'Premium user created successfully');
    }
}
