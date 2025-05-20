<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user) {
            // Skip approval check for Admins
            if ($user->hasRole('Admin')) {
                return $next($request);
            }

            // If not approved
            if (!$user->is_approved) {
                auth()->logout();
                return redirect()->route('login')->withErrors([
                    'email' => 'Your account is not approved yet.',
                ]);
            }
        }

        return $next($request);
    }
}
