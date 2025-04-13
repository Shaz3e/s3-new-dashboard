<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'loginForm']);
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/register', [RegisterController::class, 'registerForm']);
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/forgot-password', [ForgotPasswordController::class, 'forgotPasswordForm']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('forgot');

Route::get('/reset/{email}/{token}', [PasswordResetController::class, 'resetForm']);
Route::post('/reset', [PasswordResetController::class, 'reset'])->name('password.reset');
