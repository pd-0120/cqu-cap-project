<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index() {

        return view('dashboard');
    }

    public function cognifitCallback(Request $request) {
        Log::info( $request->all());
    }

	public function profile() {
		$user = Auth::user();

		return view('profile.edit', compact('user'));
	}

	public function  updateProfile(Request $request) {
		$authUser  = User::find(Auth::user()->id);
		$authUser->first_name = $request->first_name;
		$authUser->last_name = $request->last_name;
		$authUser->userDetail->phone = $request->phone;
		$authUser->userDetail->save();
		$authUser->save();
		Session::flash('message.level', 'success');
		Session::flash('message.content', 'User Profile has been updated successfully.');
		return redirect()->back();
	}
}
