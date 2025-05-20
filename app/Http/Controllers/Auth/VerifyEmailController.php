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

        // ✅ Check if user is a Caretaker and not approved
        if ($request->user()->hasRole('Caretaker') && !$request->user()->is_approved) {
            Auth::logout();

            return redirect()->route('login')->withErrors([
                'email' => 'Your account is not approved by the admin yet.',
            ]);
        }

        return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
    }
}
