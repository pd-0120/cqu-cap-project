<?php

use App\Http\Controllers\CongnitiveFitController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::resource("patient", PatientController::class);
Route::resource("location", LocationController::class);
Route::resource("tests", TestController::class);
Route::get("tests/assign-test/index", [TestController::class, 'assignTestIndex'])->name('tests.assignTestIndex');
Route::get("tests/assign-test/{patient}", [TestController::class, 'assignTest'])->name('tests.assignTest');
Route::post("tests/assign-test/{patient}", [TestController::class, 'storeAssignTest'])->name('tests.storeAssignTest');
Route::post("tests/send-test-reminder/{test}", [TestController::class, 'sendTestReminder'])->name('tests.sendTestReminder');
Route::delete("tests/assign-test/{assignTest}", [TestController::class, 'deleteAssignTest'])->name('tests.deleteAssignTest');

Route::get('delete-cognifit-account',[ CongnitiveFitController::class, 'deleteAllCognifitAccounts']);
