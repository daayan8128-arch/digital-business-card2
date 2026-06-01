<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceHttps
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // In production, replace HTTP URLs with HTTPS in the response
        if (app()->environment('production') && $this->isHtmlResponse($response)) {
            $content = $response->getContent();
            
            if (is_string($content) && strpos($content, 'http://') !== false) {
                // Replace all HTTP URLs with HTTPS for our domain
                $content = preg_replace(
                    '/href=["\']http:\/\/digital-business-card-production-a484\.up\.railway\.app\//i',
                    'href="https://digital-business-card-production-a484.up.railway.app/',
                    $content
                );
                
                $content = preg_replace(
                    '/src=["\']http:\/\/digital-business-card-production-a484\.up\.railway\.app\//i',
                    'src="https://digital-business-card-production-a484.up.railway.app/',
                    $content
                );
                
                $response->setContent($content);
            }
        }

        return $response;
    }

    /**
     * Check if the response is HTML
     */
    private function isHtmlResponse(Response $response): bool
    {
        $contentType = $response->headers->get('Content-Type', '');
        return strpos($contentType, 'text/html') !== false;
    }
}


    }
}


