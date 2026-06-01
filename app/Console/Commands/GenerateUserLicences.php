<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\UserLicence;

class GenerateUserLicences extends Command
{
    protected $signature = 'generate:user-licences';
    protected $description = 'Insert or update licences for users who have is_premium = 1 in users table';

    public function handle()
    {
        $premiumUsers = User::where('is_premium', 1)->get();

        if ($premiumUsers->isEmpty()) {
            $this->error('No premium users found in users table.');
            return Command::FAILURE;
        }

        foreach ($premiumUsers as $user) {
            UserLicence::updateOrCreate(
                ['user_id' => $user->id], // unique by user_id
                [
                    'start_date' => $user->premium_start_date ?? now(),
                    'end_date'   => $user->premium_end_date ?? now()->addYear(),
                    'admin_id'   => $user->premium_given_by, // take admin from users table
                ]
            );
        }

        $this->info("User licences generated/updated successfully for {$premiumUsers->count()} premium users.");
        return Command::SUCCESS;
    }
}
