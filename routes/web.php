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
// Dashboard (requires login + verified email + approval)
Route::get('/profile', [DashboardController::class, 'profile'])
	->middleware(['auth'])
	->name('profile');
Route::post('/profile', [DashboardController::class, 'updateProfile'])
	->middleware(['auth'])
	->name('profile.update');

Route::delete('/profile', [DashboardController::class, 'profile'])
	->middleware(['auth'])
	->name('profile.destroy');
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

// Super Admin User User Routes
Route::middleware(['auth', 'userAccess'])
->name('superadmin.')
->prefix('superadmin')
->group(function () {
    require __DIR__ . '/superadmin.php';
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
