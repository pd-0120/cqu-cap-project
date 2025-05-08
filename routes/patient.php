<?php

use App\Http\Controllers\Patient\TestController;
use App\Http\Controllers\PatientTestResultController;
use App\Models\PatientTestResult;
use Illuminate\Support\Facades\Route;


Route::name('tests.')->prefix('tests/')->group(function() {
    Route::get('index', [TestController::class, 'index'])->name('index');
    Route::get('take/{test}', [TestController::class, 'takeTest'])->name('takeTest');
    Route::get('get-test-score/{test}', [PatientTestResultController::class, 'getResult'])->name('get-result');
    Route::post('get-pre-test-result/{test}', [PatientTestResultController::class, 'updateTestResult'])->name('get-pre-test-result');
});
