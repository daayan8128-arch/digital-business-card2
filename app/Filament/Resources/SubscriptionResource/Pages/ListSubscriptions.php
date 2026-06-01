<?php

namespace App\Filament\Resources\SubscriptionResource\Pages;

use App\Filament\Resources\SubscriptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListSubscriptions extends ListRecords
{
    protected static string $resource = SubscriptionResource::class;

    protected function getHeaderActions(): array
    {
        $actions = [];

        // Only Super Admin sees "Create" button
        if (Auth::user()?->isSuperAdmin()) {
            $actions[] = Actions\CreateAction::make();
        }

        return $actions;
    }
}
