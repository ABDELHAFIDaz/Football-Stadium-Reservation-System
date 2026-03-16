<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;



Route::get('/signup', [AuthController::class , 'signup'])->name('signup');
Route::post('/register', [AuthController::class , 'register'])->name('register');
Route::get('/loginPage', [AuthController::class , 'loginPage'])->name('login.page');
Route::post('/login', [AuthController::class , 'login'])->name('login');
Route::get('/logout', [AuthController::class , 'logout'])->name('logout');