<?php

use App\Http\Controllers\CaretakerDashboardController;
use App\Http\Controllers\CongnitiveFitController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('login');
});

Route::get('/dashboard', [CaretakerDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/get-cognitit-user-access-token', [CongnitiveFitController::class,'getUserAccessToken']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// All the  patient acccessible routes
Route::middleware('patientAccess')->group(function () {
    require __DIR__.'/patient.php';
});
// All the caretaker acccessible routes
Route::middleware('caretakerAccess')->name('caretaker.')->prefix('caretaker')->group(function () {
    require __DIR__.'/caretaker.php';
});
// All the user acccessible routes
Route::middleware('userAccess')->group(function () {
    require __DIR__.'/user.php';
});
// All the admin acccessible routes
Route::middleware('adminAccess')->group(function () {
    require __DIR__.'/admin.php';
});

require __DIR__.'/auth.php';
