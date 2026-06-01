<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    // Super admin adds subscription to admin

    public function update(User $user, Request $request)
    {
        // 1. Update the user with start and end dates
        $user->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'premium_given_by' => Auth::id(), // admin giving premium
        ]);


        // 2. Identify the admin who assigned the premium (assuming the logged-in user is admin)
        $adminId = auth()->id(); // or pass it from request if needed

        // 3. Get that admin's subscription
        $subscription = Subscription::where('admin_id', $adminId)->first();

        // 4. Count how many users got premium from this admin
        $premiumCount = User::where('created_by', $adminId) // adjust this field if it's named differently
            ->whereNotNull('start_date')
            ->whereNotNull('end_date')
            ->count();

        // 5. Update the remaining_premium count
        $subscription->remaining_premium = $subscription->total_premium - $premiumCount;
        $subscription->save();

        return redirect()->back()->with('success', 'User updated');
    }

}
