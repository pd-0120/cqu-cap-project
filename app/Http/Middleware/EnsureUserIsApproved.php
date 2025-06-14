<?php

namespace App\Http\Middleware;

use App\Enum\UserRolesEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user = Auth::user();

        if ($user) {
            // Disallow if not approved
            if ($user->hasRole(UserRolesEnum::CARETAKER->value) && !$user->is_approved) {
                Auth::logout();

                return redirect()->route('login')->withErrors([
                    'email' => 'Your account is not approved by the admin yet.',
                ]);
            }
        }

        return $next($request);
    }
}
