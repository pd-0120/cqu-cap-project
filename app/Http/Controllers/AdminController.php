<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\CaretakerApprovedNotification;
use App\Mail\CaretakerDeclined;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    /**
     * Show only unapproved caretakers
     */
    public function pendingCaretakers()
    {
        $caretakers = User::role('Caretaker')->where('is_approved', false)->get();
        return view('admin.pending-caretakers', compact('caretakers'));
    }

    /**
     * Approve a caretaker
     */
    public function approveCaretaker($id)
    {
        $user = User::findOrFail($id);
        $user->is_approved = true;
        $user->save();

        $user->notify(new CaretakerApprovedNotification());

        return back()->with('success', 'Caretaker approved.');
    }

    /**
     * Decline a caretaker
     */
    public function declineCaretaker($id)
    {
        $user = User::findOrFail($id);
        Mail::to($user->email)->send(new CaretakerDeclined($user->first_name));
        $user->delete();

        return back()->with('error', 'Caretaker declined and removed.');
    }
}
