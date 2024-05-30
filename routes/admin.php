<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['title'=>'Home']);
})->name('home');



Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'login_action'])->name('login.action');
Route::get('password', [LoginController::class, 'password'])->name('password');
Route::post('password', [LoginController::class, 'password_action'])->name('password.action');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

