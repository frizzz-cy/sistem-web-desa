<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class XssSanitizer
{
    /**
     * Handle an incoming request and sanitize inputs against XSS.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('POST') || $request->isMethod('PUT') || $request->isMethod('PATCH')) {
            $input = $request->all();
            
            // Rekursif membersihkan array input
            array_walk_recursive($input, function (&$value) {
                if (is_string($value)) {
                    // 1. Netralkan tag script
                    $value = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $value);
                    
                    // 2. Netralkan event handler jahat (onerror, onload, onclick, onmouseover, dll)
                    $value = preg_replace('/(on\w+)\s*=\s*(["\']).*?\2/is', '', $value);
                    $value = preg_replace('/(on\w+)\s*=\s*[^ >]+/is', '', $value);
                    
                    // 3. Netralkan skema URI berbahaya (javascript:, vbscript:, data:text/html)
                    $value = preg_replace('/javascript\s*:/is', '', $value);
                    $value = preg_replace('/vbscript\s*:/is', '', $value);
                    $value = preg_replace('/data\s*:\s*text\/html/is', '', $value);
                }
            });

            $request->merge($input);
        }

        return $next($request);
    }
}
