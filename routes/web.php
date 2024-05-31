<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\LoginController;
Route::get('/', function () {
    return view('welcome');
});

Route::resource('myadmin', ProductController::class);
Route::post('myadmin/{kode_kue}/set-bs', [ProductController::class, 'setBestSeller']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('transactions', TransactionController::class);

Route::get('/sales', [TransactionController::class, 'sales'])->name('sales.index');

Route::middleware(['auth'])->group(function () {
    Route::resource('myadmin', ProductController::class);
    Route::post('myadmin/{kode_kue}/set-bs', [ProductController::class, 'setBestSeller']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('transactions', TransactionController::class);

    Route::get('/sales', [TransactionController::class, 'sales'])->name('sales.index');
});

Route::get('/login', [LoginController::class, 'login'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login_action'])->middleware('guest')->name('login_action');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');







