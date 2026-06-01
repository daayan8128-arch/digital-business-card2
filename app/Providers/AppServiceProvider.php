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
            // Get APP_URL from environment or construct it
            $appUrl = env('APP_URL');
            if (!$appUrl) {
                // If not set, construct from request
                $appUrl = 'https://' . (request()->getHost() ?? 'digital-business-card-production-a484.up.railway.app');
            } else if (strpos($appUrl, 'http://') === 0) {
                // Replace http with https
                $appUrl = 'https://' . substr($appUrl, 7);
            }
            
            // Force the URL configuration
            Config::set('app.url', $appUrl);
            URL::forceRootUrl($appUrl);
            URL::forceScheme('https');
        }

        View::addNamespace('namespace', resource_path('views'));

        // Yaha observer ko register karo
        User::observe(UserObserver::class);
    }
    
}
