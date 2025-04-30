<?php

use App\Http\Controllers\Patient\TestController;
use Illuminate\Support\Facades\Route;


Route::get('tests/index', [TestController::class, 'index'])->name('tests.index');
Route::get('test/take//{test}', [TestController::class, 'takeTest'])->name('tests.takeTest');