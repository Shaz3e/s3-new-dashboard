<?php

use App\Http\Controllers\AccountProfileController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;

Route::post('/logout', LogoutController::class)->name('logout');

Route::get('/', DashboardController::class)->name('dashboard');

Route::get('/profile', [AccountProfileController::class, 'profile'])->name('profile');
Route::post('/profile', [AccountProfileController::class, 'update'])->name('profile.update');

Route::resource('/clients', ClientController::class);
Route::get('/client/{client}/loginAs', [ClientController::class, 'loginAsClient'])->name('login.as.client');
Route::get('/stop-impersonation', [ClientController::class, 'stopImpersonating'])->name('stop.impersonation');

Route::prefix('/manage')->group(function () {
    Route::resource('/users', UserController::class);

    Route::resource('/roles', RoleController::class);
});
