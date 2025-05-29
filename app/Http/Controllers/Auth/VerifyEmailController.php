<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        $user = $request->user();

        // ✅ Check if user is NOT approved and is NOT an Admin
        if (!$user->is_approved && !$user->hasRole('Admin')) {
            Auth::logout();

            return redirect()->route('login')->withErrors([
                'email' => 'Your email is verified, but your account is pending admin approval.',
            ]);
        }

        return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
    }
}
