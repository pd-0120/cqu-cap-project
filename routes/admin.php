<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ActivityController;
Route::get('activity-log', [ActivityController::class, 'index'])->name('activity-log');
