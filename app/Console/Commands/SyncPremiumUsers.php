<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\UserLicence;

class SyncPremiumUsers extends Command
{
    protected $signature = 'sync:premium-users';
    protected $description = 'Sync premium users from users table into user_licences table';

    public function handle()
    {
        $premiumUsers = User::where('is_premium', '1')->get();

        foreach ($premiumUsers as $user) {
            UserLicence::updateOrCreate(
                ['user_id' => $user->id], // condition (अगर पहले से है तो update होगा)
                [
                    'admin_id'   => $user->admin_id ?? 1, // fallback अगर admin_id null है
                    'start_date' => $user->start_date,
                    'end_date'   => $user->end_date,
                    'is_premium' => $user->is_premium,
                ]
            );
        }

        $this->info("✅ Premium users synced into user_licences table.");
    }
}
