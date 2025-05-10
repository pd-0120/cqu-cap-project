<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GeminiController;

use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/get-gemini', [GeminiController::class, 'getGemini'])->name('get-gemini');
Route::post('/cognifitCallback', [DashboardController::class, 'cognifitCallback']);
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// All the  patient acccessible routes
Route::middleware('patientAccess')->name('patient.')->prefix('patient')->group(function () {
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
