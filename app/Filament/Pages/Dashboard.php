<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Concerns\HasRoutes;

class Dashboard extends BaseDashboard
{
    use HasRoutes;

    // Sidebar navigation me icon
    protected static ?string $navigationIcon = 'heroicon-o-home';

    // Agar aap widgets add karna chahte ho:
    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\PremiumStatus::class,
        ];
    }
}
