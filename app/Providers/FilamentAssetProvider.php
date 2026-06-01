<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentAsset;

class FilamentAssetProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Override Filament's asset URL generation to use HTTPS in production
        if (app()->environment('production')) {
            // Use a custom asset URL macro
            \Illuminate\Support\Facades\URL::macro('filaAsset', function ($path) {
                return 'https://' . request()->getHost() . '/' . trim($path, '/');
            });
        }
    }
}
