<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show a list of caretakers for approval.
     */
    public function showCaretakers()
    {
        $caretakers = User::where('role', 'Caretaker')->get();
        return view('admin.caretakers.index', compact('caretakers'));
    }

    /**
     * Approve a caretaker by setting is_approved to true.
     */
    public function approveCaretaker($id)
    {
        $user = User::findOrFail($id);
        $user->is_approved = true;
        $user->save();

        return redirect()->back()->with('success', 'Caretaker approved successfully!');
    }

    /**
     * Reject a caretaker by setting is_approved to false.
     */
    public function rejectCaretaker($id)
    {
        $user = User::findOrFail($id);
        $user->is_approved = false;
        $user->save();

        return redirect()->back()->with('success', 'Caretaker rejected successfully!');
    }
}
