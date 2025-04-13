<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return 'login page';
})->name('login');
