<?php

use App\Http\Controllers\Admin\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Admin\CaretakerController;

// Caretaker routes grouped with prefix 'caretakers' and named 'caretakers.'
Route::prefix('caretakers')->name('caretakers.')->group(function () {
    Route::get('/', [CaretakerController::class, 'index'])->name('index');
    Route::get('/create', [CaretakerController::class, 'create'])->name('create');
    Route::post('/', [CaretakerController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [CaretakerController::class, 'edit'])->name('edit');
    Route::put('/{id}', [CaretakerController::class, 'update'])->name('update');
    Route::delete('/{id}', [CaretakerController::class, 'destroy'])->name('destroy');

    // Approve and Reject actions
    Route::post('/{id}/approve', [CaretakerController::class, 'approve'])->name('approve');
    Route::post('/{id}/reject', [CaretakerController::class, 'reject'])->name('reject');
});

// Other admin routes
Route::get('activity-log', [ActivityController::class, 'index'])->name('activity-log');

Route::resource('patient', PatientController::class);
Route::get('patient/assign-caretaker/{patient}', [PatientController::class, 'assignCaretaker'])->name('patient.assign-caretaker');
Route::post('patient/assign-caretaker/{patient}', [PatientController::class, 'storeAssignCaretaker'])->name('patient.store-assign-caretaker');

Route::resource('location', LocationController::class);

Route::prefix('tests')->name('test.')->group(function () {
    Route::get('/', [TestController::class, 'index'])->name('index');
    Route::get('/assign-tests', [TestController::class, 'assignTests'])->name('assignTests');
    Route::get('/result/{test}', [TestController::class, 'testResult'])->name('testResult');
    Route::get('/patient/{patient}', [TestController::class, 'patientTests'])->name('patientTests');
});