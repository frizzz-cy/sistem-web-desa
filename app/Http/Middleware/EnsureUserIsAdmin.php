<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || !$request->user()->isAdmin()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Akses ditolak. Fitur ini hanya dapat diakses oleh Administrator Desa.'
                ], 403);
            }

            return redirect('/admin/dashboard')->with('error', 'Akses ditolak! Menu tersebut khusus untuk Administrator Desa.');
        }

        return $next($request);
    }
}
