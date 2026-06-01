<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class ForceHttps
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if we're in production or if X-Forwarded-Proto header indicates HTTPS
        if (app()->environment('production') || $request->header('X-Forwarded-Proto') === 'https') {
            URL::forceScheme('https');
        }

        $response = $next($request);

        // Replace HTTP URLs with HTTPS in the response body for Filament assets
        if ($request->path() === 'login/login' || strpos($request->path(), '/login') === 0) {
            if ($response->getStatusCode() === 200) {
                $content = $response->getContent();
                
                // Replace HTTP URLs with HTTPS for assets (but not for action URLs that might be http)
                $content = str_replace(
                    'http://digital-business-card-production-a484.up.railway.app/css/',
                    'https://digital-business-card-production-a484.up.railway.app/css/',
                    $content
                );
                $content = str_replace(
                    'http://digital-business-card-production-a484.up.railway.app/js/',
                    'https://digital-business-card-production-a484.up.railway.app/js/',
                    $content
                );
                
                $response->setContent($content);
            }
        }

        return $response;
    }
}
