<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EmailCodeVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Bypass email verification if impersonating
        if (session()->has('impersonate')) {
            return $next($request);
        }

        // Check if user is logged in, not verified, and not already on the verification page
        if (Auth::check()) {
            if (Auth::user()->email_verified_at == null && ! $request->is('verification')) {
                return redirect()->route('verification');
            }
        }

        return $next($request);
    }
}
