<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class PremiumStatus extends Widget
{
    protected static string $view = 'filament.widgets.premium-status';

    protected function getViewData(): array
    {
        // Agar user login nahi hai to blank safe data bhejo
        if (! Auth::check()) {
            return [
                'has_premium' => false,
                'start_date'  => null,
                'end_date'    => null,
            ];
        }

        $user = Auth::user();

        return [
            'has_premium' => (bool) ($user->is_premium ?? false),
            'start_date'  => $user->premium_start_date,
            'end_date'    => $user->premium_end_date,
        ];
    }
}
