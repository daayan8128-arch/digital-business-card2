<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use App\Models\User;
use App\Observers\UserObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS URLs in production after all middleware has run
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        View::addNamespace('namespace', resource_path('views'));

        // Yaha observer ko register karo
        User::observe(UserObserver::class);
    }
    
}
