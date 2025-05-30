<?php

namespace App\Http\Controllers\Auth;

use App\Enum\UserRolesEnum;
use App\Http\Controllers\Controller;
use App\Mail\AlertAdminOfCaretakerRegistrationMail;
use App\Models\User;
use App\Models\UserDetail;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CaretakerApprovedNotification;
use App\Notifications\NewCaretakerRegistrationNotification;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
   public function store(Request $request): RedirectResponse
{
    $request->validate([
        'first_name' => ['required', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
        'password' => ['required', 'confirmed', Rules\Password::min(8)->mixedCase()->numbers()->symbols()],
    ]);

    $user = User::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'secret_password' => Crypt::encrypt($request->password),
        'dob' => '1988-10-10',
        'is_approved' => false, // 🚫 Not approved by default
    ]);

    UserDetail::create(['user_id' => $user->id]);

    // Assign Caretaker role
    $user->assignRole(UserRolesEnum::CARETAKER->value);

    // 📩 Notify admin of new registration

    $admin = User::role(UserRolesEnum::ADMIN->value)->first();

    event(new Registered($user));
    
    if($admin) {
        Mail::to($admin->email)->send(new AlertAdminOfCaretakerRegistrationMail($user));
    }


    // ✅ Show user a message
    return redirect()->route('login')->with('status', 'Registration successful. Please wait for admin approval.');
}
}
