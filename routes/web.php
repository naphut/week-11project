<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

// Show login form
Route::get('/', function () {
    return view('login');
});

// Handle login form submission
Route::post('/go', [LoginController::class, 'login'])->name('login');

// Show dashboard page
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Order routes
Route::resource('orders', OrderController::class);
Route::put('orders/{order}', [OrderController::class, 'update']);

// Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
