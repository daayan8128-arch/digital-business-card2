<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Model;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data = parent::mutateFormDataBeforeFill($data);
        
        if (!empty($data['premium_start_date'])) {
            $data['premium_start_date'] = Carbon::parse($data['premium_start_date'])->format('Y-m-d');
        }
        
        if (!empty($data['premium_end_date'])) {
            $data['premium_end_date'] = Carbon::parse($data['premium_end_date'])->format('Y-m-d');
        }
        
        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $authUser = auth()->user();
        
        // Handle premium logic
        $wasPremium = (bool) $record->is_premium;
        $isPremiumNow = (bool) ($data['is_premium'] ?? false);

        if ($isPremiumNow && !$wasPremium) {
            // Giving premium to user who was not premium before
            if ($authUser->isSuperAdmin()) {
                $data['premium_start_date'] = now();
                $data['premium_end_date'] = now()->addYear();
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
                    $subscription->decrement('remaining_premium_users');
                    $data['premium_start_date'] = now();
                    $data['premium_end_date'] = now()->addYear();
                    $data['premium_given_by'] = $authUser->id;
                    
                    \Log::info("Subscription decremented on edit. Admin: {$authUser->id}, Remaining: {$subscription->remaining_premium_users}");
                } else {
                    abort(403, 'You have no active premium subscriptions remaining.');
                }
            }
        } elseif (!$isPremiumNow && $wasPremium) {
            // Removing premium from user who was premium before
            if ($authUser->isAdmin() && $record->premium_given_by === $authUser->id) {
                $subscription = Subscription::where('admin_id', $authUser->id)
                    ->whereDate('start_date', '<=', now())
                    ->where(function ($q) {
                        $q->whereNull('end_date')->orWhere('end_date', '>=', now());
                    })
                    ->orderBy('end_date', 'desc')
                    ->lockForUpdate()
                    ->first();

                if ($subscription) {
                    $subscription->increment('remaining_premium_users');
                    $data['premium_start_date'] = null;
                    $data['premium_end_date'] = null;
                    $data['premium_given_by'] = null;
                    
                    \Log::info("Subscription incremented on edit. Admin: {$authUser->id}, Remaining: {$subscription->remaining_premium_users}");
                }
            }
        }

        // Remove password fields from data
        unset($data['current_password'], $data['new_password'], $data['new_password_confirmation']);

        // Update the record
        $record->update($data);

        return $record;
    }

    protected function afterSave(): void
    {
        $data = $this->data;
        $record = $this->record;

        // Handle password change
        if ($record && $record->id === auth()->id() && !empty($data['new_password'])) {
            $record->password = Hash::make($data['new_password']);
            $record->save();
        }
    }
}