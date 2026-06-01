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
        // Force HTTPS in production (Railway uses HTTPS with reverse proxy)
        if (app()->environment('production') || request()->header('X-Forwarded-Proto') === 'https') {
            URL::forceScheme('https');
        }

        View::addNamespace('namespace', resource_path('views'));

        // Yaha observer ko register karo
        User::observe(UserObserver::class);
    }
    
}
