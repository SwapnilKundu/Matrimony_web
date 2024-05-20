<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and is of type "admin"
        if ($request->user() && $request->user()->user_type === 'admin') {
            return $next($request);
        }

        // Redirect or return an error response if not authorized
        return redirect()->route('home')->with('error', 'Unauthorized access');
    }
}
