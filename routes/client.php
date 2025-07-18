<?php

use App\Http\Controllers\AccountProfileController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Client\DashboardController;
use Illuminate\Support\Facades\Route;

Route::post('/logout', LogoutController::class)->name('logout');

Route::get('/', DashboardController::class)->name('dashboard');

Route::get('/profile', [AccountProfileController::class, 'profile'])->name('profile');
Route::post('/profile', [AccountProfileController::class, 'update'])->name('profile.update');
