<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GeminiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

// Public Routes
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/get-gemini', [GeminiController::class, 'getGemini'])->name('get-gemini');
Route::post('/cognifitCallback', [DashboardController::class, 'cognifitCallback']);

// Dashboard (requires login + verified email + approved user)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'user.approved'])
    ->name('dashboard');

// Profile Routes (only for logged-in, verified & approved users)
Route::middleware(['auth', 'verified', 'user.approved'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Patient Routes (accessible only by patients)
Route::middleware('patientAccess')->name('patient.')->prefix('patient')->group(function () {
    require __DIR__ . '/patient.php';
});

// Caretaker Routes (accessible only by caretakers AND approved users)
Route::middleware(['caretakerAccess', 'user.approved'])->name('caretaker.')->prefix('caretaker')->group(function () {
    require __DIR__ . '/caretaker.php';
});

// General User Routes (authenticated + verified + approved)
Route::middleware(['auth', 'verified', 'user.approved', 'userAccess'])->group(function () {
    require __DIR__ . '/user.php';
});

// Admin Panel Routes (accessible only by admin)
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/caretakers/pending', [AdminController::class, 'pendingCaretakers'])->name('admin.caretakers.pending');
    Route::post('/admin/caretakers/approve/{id}', [AdminController::class, 'approveCaretaker'])->name('admin.caretakers.approve');
    Route::post('/admin/caretakers/decline/{id}', [AdminController::class, 'declineCaretaker'])->name('admin.caretakers.decline');
});

// Authentication Routes (login, register, etc.)
require __DIR__ . '/auth.php';
