<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\LocationController;

Route::get('activity-log', [ActivityController::class, 'index'])->name('activity-log');
Route::resource("patient", PatientController::class);
Route::get('patient/assign-caretaker/{patient}', [PatientController::class, 'assignCaretaker'])->name('patient.assign-caretaker');
Route::post('patient/assign-caretaker/{patient}', [PatientController::class, 'storeAssignCaretaker'])->name('patient.store-assign-caretaker');
Route::resource("location", LocationController::class);
