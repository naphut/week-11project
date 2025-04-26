<?php

use App\Http\Controllers\DashboardController; // Add this import
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('orders', OrderController::class);
Route::put('orders/{order}', [OrderController::class, 'update'])->name('orders.update');
