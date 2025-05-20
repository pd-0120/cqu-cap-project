<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

// Show pending caretakers list
Route::get('/caretakers/pending', [AdminController::class, 'pendingCaretakers'])->name('admin.pendingCaretakers');

// Approve caretaker
Route::post('/caretakers/{id}/approve', [AdminController::class, 'approveCaretaker'])->name('admin.approveCaretaker');

// Decline caretaker
Route::post('/caretakers/{id}/reject', [AdminController::class, 'declineCaretaker'])->name('admin.declineCaretaker');
