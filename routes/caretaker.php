<?php

use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

Route::resource("patient", PatientController::class);