<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class ForceHttps
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (app()->environment('production')) {
            // Get APP_URL from environment  
            $appUrl = env('APP_URL');
            
            if ($appUrl) {
                // Ensure HTTPS
                if (strpos($appUrl, 'http://') === 0) {
                    $appUrl = str_replace('http://', 'https://', $appUrl);
                }
            } else {
                // Fallback to constructing from request
                $appUrl = 'https://' . $request->getHost();
            }
            
            // Set configuration and force URLs
            Config::set('app.url', $appUrl);
            URL::forceRootUrl($appUrl);
            URL::forceScheme('https');
        }

        return $next($request);
    }
}

    }
}


