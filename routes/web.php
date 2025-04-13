<?php

use Illuminate\Support\Facades\Route;

// All redirect Routes URLs
// require __DIR__.'/redirect.php';

require __DIR__.'/auth.php';

// Admin Routes
Route::middleware([
    'auth',
    // 'locked',
    // 'verification',
    // 'suspended',
])
    // ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        require __DIR__.'/admin.php';
    });

// Client Routes
Route::middleware([
    'auth',
    // 'locked',
    // 'verification',
    // 'suspended',
])
    ->prefix('my')
    ->name('client.')
    ->group(function () {
        require __DIR__.'/client.php';
    });
