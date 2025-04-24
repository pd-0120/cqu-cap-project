<?php

use App\Http\Controllers\CongnitiveFitController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::resource("patient", PatientController::class);
Route::resource("location", LocationController::class);
Route::resource("tests", TestController::class);
Route::get('delete-cognifit-account',[ CongnitiveFitController::class, 'deleteAllCognifitAccounts']);