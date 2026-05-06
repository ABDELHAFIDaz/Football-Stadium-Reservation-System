<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ManagerDashboardController;
use App\Http\Controllers\StadiumController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\HomeController;
use App\Models\City;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/pitches', [StadiumController::class, 'index'])->name('pitches');

Route::middleware(['role:manager'])->group(function(){

    Route::get('/manager/dashboard', [ManagerDashboardController::class, 'index'])->name('manager.dashboard');
    Route::get('/manager/reservations', [ManagerDashboardController::class, 'reservations'])->name('manager.reservations');
    Route::get('/manager/stadiums', [ManagerDashboardController::class, 'stadiums'])->name('manager.stadiums');
});


Route::middleware(['role:customer'])->group(function () {

    Route::get('/customerDashboard', [CustomerDashboardController::class, 'index'])->name('user.dashboard');
});


Route::middleware(['role:customer,manager'])->group(function(){

    Route::patch('/updateProfile', [CustomerDashboardController::class, 'update'])->name('update.profile')->middleware(['role:customer,manager']);
});


Route::middleware(['role:admin'])->group(function () {

    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [AdminDashboardController::class, 'users'])->name('admin.users');
    Route::get('/admin/pitches', [AdminDashboardController::class, 'pitches'])->name('admin.pitches');
    Route::post('/users/{user}/toggle-ban', [AdminDashboardController::class, 'toggleBan'])->name('admin.toggle-ban');
    Route::post('/users/manager', [AdminDashboardController::class, 'storeManager'])->name('admin.users.storeManager');
    Route::post('/addStad', [StadiumController::class, 'store'])->name('admin.addStad');
    Route::delete('/removeStad/{stadium}', [StadiumController::class, 'destroy'])->name('admin.removeStad');
});


Route::middleware(['role:admin,manager'])->group(function(){

    Route::put('/editStad/{stadium}', [StadiumController::class, 'update'])->name('admin.editStad');
});


require_once "Auth.php";
require_once "booking.php";
