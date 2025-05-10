<?php

use App\Http\Controllers\CongnitiveFitController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientTestResultController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::resource("patient", PatientController::class);
Route::resource("location", LocationController::class);
Route::resource("tests", TestController::class);

Route::name('tests.')->prefix('tests/')->group(function() {
    Route::get("assign-test/index", [TestController::class, 'assignTestIndex'])->name('assignTestIndex');
    Route::get("assign-test/{patient}", [TestController::class, 'assignTest'])->name('assignTest');
    Route::post("assign-test/duplicate/{test}", [TestController::class, 'duplicateAssignTest'])->name('duplicate-test');
    Route::post("send-test-reminder/{test}", [TestController::class, 'sendTestReminder'])->name('sendTestReminder');
    Route::delete("assign-test/{assignTest}", [TestController::class, 'deleteAssignTest'])->name('deleteAssignTest');
	Route::post("assign-test/{patient}", [TestController::class, 'storeAssignTest'])->name('storeAssignTest');
	Route::post("get-ai-suggestion/{patient}", [TestController::class, 'getAISuggestion'])->name('getAISuggestion');
    Route::get('get-test-score/{test}', [PatientTestResultController::class, 'getResult'])->name('get-result');
});


Route::get('delete-cognifit-account', action: [ CongnitiveFitController::class, 'deleteAllCognifitAccounts']);

