<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

//route yang bisa diakses ketika user belum login
Route::middleware('guest')->group(function (){
    Route::get('/login',[AuthController::class,'index'])->name('login');
    Route::post('/auth',[AuthController::class,'auth'])->name('auth');
});

//route yang bisa diakses ketika user sudah login
Route::middleware('auth')->group(function (){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
