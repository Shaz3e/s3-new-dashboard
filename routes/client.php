<?php

use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Client\DashboardController;
use Illuminate\Support\Facades\Route;

Route::post('/logout', LogoutController::class)->name('logout');

Route::get('/', DashboardController::class)->name('dashboard');
