<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index() {
        

        return view('dashboard');
    }

    public function cognifitCallback(Request $request) {
        Log::info( $request->all());
    }
}
