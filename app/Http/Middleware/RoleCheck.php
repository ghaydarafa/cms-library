<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (Auth::check()) {
            foreach ($roles as $role) {
                if (Auth::user()->role == $role) {
                    return $next($request);  // Continue to the requested route
                }
            }

            // If user is authenticated but doesn't have the required role
            Auth::logout();
            return redirect()->route('login')->with('status', 'You are not authorized to access this page.');
        }

        // If user is not authenticated, redirect to login
        return redirect()->route('login');
    }
}
