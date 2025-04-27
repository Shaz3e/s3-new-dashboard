<?php

use App\Http\Controllers\AccountProfileController;
use App\Http\Controllers\Admin\AppBackupController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\Admin\GlobalEmailTemplateController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;

Route::post('/logout', LogoutController::class)->name('logout');

Route::get('/dashboard', DashboardController::class)->name('dashboard');

Route::get('/profile', [AccountProfileController::class, 'profile'])->name('profile');
Route::post('/profile', [AccountProfileController::class, 'update'])->name('profile.update');

Route::resource('/clients', ClientController::class);
Route::get('/client/{client}/loginAs', [ClientController::class, 'loginAsClient'])->name('login.as.client');
Route::get('/stop-impersonation', [ClientController::class, 'stopImpersonating'])->name('stop.impersonation');

Route::prefix('/manage')->group(function () {
    // Users
    Route::resource('/users', UserController::class);
    // Roles
    Route::resource('/roles', RoleController::class);

    // Email Templates
    Route::resource('/email-templates', EmailTemplateController::class);

    // Global Email Templates
    Route::prefix('/global-email-templates')->name('global-email-templates.')->group(function () {
        Route::get('/', [GlobalEmailTemplateController::class, 'index'])->name('index');
        Route::get('/edit', [GlobalEmailTemplateController::class, 'edit'])->name('edit');
        Route::post('/update', [GlobalEmailTemplateController::class, 'update'])->name('update');
    });
});

Route::prefix('app-backup')->group(function () {
    Route::get('/', [AppBackupController::class, 'index'])->name('app-backup.index');
    Route::post('/', [AppBackupController::class, 'store'])->name('app-backup.store');
    Route::get('/download/{fileName}', [AppBackupController::class, 'download'])->name('app-backup.download');
    Route::delete('/delete/{fileName}', [AppBackupController::class, 'delete'])->name('app-backup.delete');
});
