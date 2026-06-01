<?php

namespace App\Filament\Resources\BusinessDetailsResource\Pages;

use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BusinessDetailsResource;
use Filament\Resources\Pages\ListRecords;

class ListBusinessDetails extends ListRecords
{
    protected static string $resource = BusinessDetailsResource::class;

    protected function getTableQuery(): ?Builder
    {
        $query = parent::getTableQuery();
        $user = auth()->user();

        // SuperAdmin sees all
        if ($user->isSuperAdmin()) {
            return $query;
        }

        // Admin/User sees only their own records
        return $query->where('user_id', $user->id);
    }
}
