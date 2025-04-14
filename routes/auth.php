<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LockedController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'loginForm']);
    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::get('/register', [RegisterController::class, 'registerForm']);
    Route::post('/register', [RegisterController::class, 'register'])->name('register');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'forgotPasswordForm']);
    Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('forgot');

    Route::get('/reset/{email}/{token}', [PasswordResetController::class, 'resetForm']);
    Route::post('/reset', [PasswordResetController::class, 'reset'])->name('password.reset');
});

Route::middleware('auth')->group(function () {

    // Locked
    Route::get('/locked', [LockedController::class, 'view']);
    Route::post('/locked', [LockedController::class, 'post'])->name('locked');

    // // Suspended
    // Route::get('/suspended', function () {
    //     return view('auth.suspended');
    // })->name('suspended');
});
