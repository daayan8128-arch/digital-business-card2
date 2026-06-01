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
        // Force HTTPS scheme early
        if (app()->environment('production') || $request->header('X-Forwarded-Proto') === 'https') {
            URL::forceScheme('https');
            \Illuminate\Support\Facades\URL::forceRootUrl('https://' . $request->getHost());
        }

        $response = $next($request);

        // Replace HTTP with HTTPS in HTML response content
        if ($response instanceof \Illuminate\Http\Response || $response instanceof \Illuminate\Http\JsonResponse) {
            if (strpos($response->headers->get('Content-Type', ''), 'text/html') !== false) {
                $content = $response->getContent();
                
                // Simple regex to replace http:// with https:// for our domain only
                if (strpos($content, 'http://digital-business-card-production-a484.up.railway.app') !== false) {
                    $content = str_replace(
                        'http://digital-business-card-production-a484.up.railway.app',
                        'https://digital-business-card-production-a484.up.railway.app',
                        $content
                    );
                    $response->setContent($content);
                }
            }
        }

        return $response;
    }
}


