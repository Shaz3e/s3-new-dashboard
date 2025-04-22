<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserSuspendedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Bypass suspended if impersonating
        if (session()->has('impersonate')) {
            return $next($request);
        }

        if (Auth::check()) {
            if (Auth::user()->is_suspended) {
                // Auth::logout();
                return redirect()->route('suspended');
            }
        }

        return $next($request);
    }
}
