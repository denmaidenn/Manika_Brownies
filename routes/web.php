<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

use App\Http\Controllers\ProductController;

Route::resource('myadmin', ProductController::class);

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

use App\Http\Controllers\TransactionController;

Route::resource('transactions', TransactionController::class);




use App\Http\Controllers\LoginController;

Route::get('/login', [LoginController::class, 'login'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login_action'])->middleware('guest')->name('login_action');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');





