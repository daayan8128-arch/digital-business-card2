<?php

namespace App\Observers;

use App\Models\User;
use App\Models\UserLicence;
use App\Models\BusinessDetail;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // 🔹 Premium Licence Logic (Same as your old one)
        if ($user->is_premium == 1 && $user->premium_given_by) {
            UserLicence::create([
                'user_id'   => $user->id,
                'admin_id'  => $user->premium_given_by, // jisne premium diya
                'start_date'=> $user->premium_start_date ?? now(),
                'end_date'  => $user->premium_end_date ?? now()->addYear(),
                'is_premium'=> '1',
            ]);
        }

        // 🔹 Business Details Auto Create Logic (New)
        BusinessDetail::create([
            'user_id'       => $user->id,
            'name'          => $user->name,
            'business_name' => $user->company_name ?? '', // agar company_name field User table me hai
            'email'         => $user->email,
        ]);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        // 🔹 Premium Licence Update Logic (Same as your old one)
        if ($user->isDirty('is_premium') || $user->isDirty('premium_given_by')) {
            // Agar user ko baad me premium banaya gaya ho
            if ($user->is_premium == 1 && $user->premium_given_by) {
                $licence = UserLicence::where('user_id', $user->id)->first();

                if (!$licence) {
                    UserLicence::create([
                        'user_id'   => $user->id,
                        'admin_id'  => $user->premium_given_by,
                        'start_date'=> $user->premium_start_date ?? now(),
                        'end_date'  => $user->premium_end_date ?? now()->addYear(),
                        'is_premium'=> '1',
                    ]);
                } else {
                    // Update existing licence
                    $licence->update([
                        'admin_id'  => $user->premium_given_by,
                        'start_date'=> $user->premium_start_date ?? now(),
                        'end_date'  => $user->premium_end_date ?? now()->addYear(),
                        'is_premium'=> '1',
                    ]);
                }
            } else {
                // Agar premium hata diya jaye
                UserLicence::where('user_id', $user->id)->update([
                    'is_premium' => '0',
                ]);
            }
        }
    }
}
