<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;
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
        // Force HTTPS in production
        if (app()->environment('production')) {
            // Set the app URL to use HTTPS
            $host = request()->getHost();
            $appUrl = 'https://' . $host;
            Config::set('app.url', $appUrl);
            URL::forceRootUrl($appUrl);
            URL::forceScheme('https');
        }

        View::addNamespace('namespace', resource_path('views'));

        // Yaha observer ko register karo
        User::observe(UserObserver::class);
    }
    
}
