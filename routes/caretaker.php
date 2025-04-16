<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::resource("patient", PatientController::class);
Route::resource("location", LocationController::class);
Route::resource("tests", TestController::class);