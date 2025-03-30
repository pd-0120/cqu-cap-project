<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CaretakerDashboardController extends Controller
{
    public function index() {
        $totalAssingnedPatients = User::where("caretaker_id", Auth::user()->id)->count();

        return view('dashboard', compact('totalAssingnedPatients'));
    }
}
