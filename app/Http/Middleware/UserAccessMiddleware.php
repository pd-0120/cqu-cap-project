<?php

namespace App\Http\Middleware;

use App\Enum\UserRolesEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response|string
    {
        return Auth::user() && Auth::user()->hasRole(UserRolesEnum::SUPERADMIN->value) ? $next($request) : redirect(route('login'));
    }
}
