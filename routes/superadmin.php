<?php

use Illuminate\Support\Facades\Route;

Route::resource('admins', App\Http\Controllers\SuperAdmin\AdminController::class);