<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;

Route::post('/logout', LogoutController::class)->name('logout');

Route::get('/', DashboardController::class)->name('dashboard');
