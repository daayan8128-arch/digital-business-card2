<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class ForceHttps
{
    /**
     * Handle an incoming request - runs BEFORE rendering views
     */
    public function handle(Request $request, Closure $next): Response
    {
        // In production, force HTTPS URLs before views are rendered
        if (app()->environment('production')) {
            // Get the HTTPS version of the current app URL
            $appUrl = env('APP_URL', 'https://' . $request->getHost());
            
            // Ensure it's HTTPS
            $appUrl = str_replace('http://', 'https://', $appUrl);
            
            // Force the URL scheme and root before rendering
            URL::forceScheme('https');
            URL::forceRootUrl($appUrl);
            
            \Log::info('ForceHttps middleware: Set URLs', [
                'app_url' => $appUrl,
                'scheme' => 'https'
            ]);
        }

        return $next($request);
    }
}



    }
}


