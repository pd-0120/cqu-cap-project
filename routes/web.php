<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GeminiController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/get-gemini', [GeminiController::class, 'getGemini'])->name('get-gemini');
Route::post('/cognifitCallback', [DashboardController::class, 'cognifitCallback']);

// Dashboard (requires login + verified email + approval)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'user.approved'])
    ->name('dashboard');

// Profile Routes (logged-in & approved users only)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Patient Routes (must be approved)
Route::middleware(['auth', 'user.approved', 'patientAccess'])
    ->name('patient.')
    ->prefix('patient')
    ->group(function () {
        require __DIR__ . '/patient.php';
    });

// Caretaker Routes (must be approved)
Route::middleware(['auth', 'user.approved', 'caretakerAccess'])
    ->name('caretaker.')
    ->prefix('caretaker')
    ->group(function () {
        require __DIR__ . '/caretaker.php';
    });

// General User Routes (must be approved)
Route::middleware(['auth', 'user.approved', 'userAccess'])->group(function () {
    require __DIR__ . '/user.php';
});

// Admin Panel Routes (Admins skip approval check)
Route::middleware(['auth', 'adminAccess'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        require __DIR__ . '/admin.php';
    });

// Authentication Routes
require __DIR__ . '/auth.php';
