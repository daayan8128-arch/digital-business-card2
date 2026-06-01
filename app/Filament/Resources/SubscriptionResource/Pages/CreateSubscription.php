<?php

namespace App\Filament\Resources\SubscriptionResource\Pages;

use App\Filament\Resources\SubscriptionResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateSubscription extends CreateRecord
{
    protected static string $resource = SubscriptionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = Auth::user();

        // Track who created this subscription
        $data['created_by'] = $user->id;

        // Remaining premium users = total premium users
        $data['remaining_premium_users'] = $data['total_premium_users'];

        // If not Super Admin, set default dates
        if (!$user->isSuperAdmin()) {
            $data['start_date'] = now();
            $data['end_date'] = now()->addYear();
        }

        // If Admin creating, assign themselves as admin_id
        if ($user->isAdmin() && empty($data['admin_id'])) {
            $data['admin_id'] = $user->id;
        }

        return $data;
    }

    // Role-based access: only Super Admin or Admin
    protected function authorizeAccess(): void
    {
        $user = Auth::user();
        abort_unless($user->isSuperAdmin() || $user->isAdmin(), 403);
    }

    // Redirect after creation
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
