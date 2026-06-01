<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use App\Models\Subscription;
use Carbon\Carbon;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $authUser = auth()->user();
        $data['created_by'] = $authUser->id ?? null;

        // Handle password
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        // Handle premium user creation
        if (isset($data['is_premium']) && $data['is_premium']) {
            if ($authUser->isSuperAdmin()) {
                $data['premium_start_date'] = $data['premium_start_date'] ?? now();
                $data['premium_end_date'] = $data['premium_end_date'] ?? now()->addYear();
                $data['premium_given_by'] = $authUser->id;
            } elseif ($authUser->isAdmin()) {
                $subscription = Subscription::where('admin_id', $authUser->id)
                    ->whereDate('start_date', '<=', now())
                    ->where(function ($q) {
                        $q->whereNull('end_date')->orWhere('end_date', '>=', now());
                    })
                    ->where('remaining_premium_users', '>', 0)
                    ->orderBy('end_date', 'desc')
                    ->lockForUpdate()
                    ->first();

                if ($subscription) {
                    // Decrement subscription count
                    $subscription->decrement('remaining_premium_users');
                    $data['premium_start_date'] = now();
                    $data['premium_end_date'] = now()->addYear();
                    $data['premium_given_by'] = $authUser->id;
                    
                    \Log::info("Subscription decremented on create. Admin: {$authUser->id}, Remaining: {$subscription->remaining_premium_users}");
                } else {
                    abort(403, 'You have no active premium subscriptions remaining.');
                }
            }
        }

        return $data;
    }

    protected function afterCreate(): void
    {
        $record = $this->record;
        $data = $this->data;
        
        // Handle password change if needed
        if (!empty($data['new_password'])) {
            $record->password = Hash::make($data['new_password']);
            $record->save();
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}