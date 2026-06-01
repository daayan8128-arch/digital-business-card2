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

        // Try to modify the response content to replace HTTP with HTTPS
        try {
            // Check if this is a view response with content
            if (method_exists($response, 'getContent')) {
                $content = $response->getContent();
                
                if ($content && is_string($content) && strpos($content, 'http://digital-business-card-production-a484.up.railway.app') !== false) {
                    // Replace all occurrences
                    $newContent = str_replace(
                        'http://digital-business-card-production-a484.up.railway.app',
                        'https://digital-business-card-production-a484.up.railway.app',
                        $content
                    );
                    
                    if ($newContent !== $content) {
                        $response->setContent($newContent);
                    }
                }
            }
        } catch (\Exception $e) {
            // Silently fail if something goes wrong
        }

        return $response;
    }
}


