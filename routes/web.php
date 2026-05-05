<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\StadiumController;
use App\Http\Controllers\UserDashboardController;
use App\Models\City;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $cities = City::all();
    return view('home', compact('cities'));
})->name('home');


Route::get('/pitches', [StadiumController::class, 'index'])->name('pitches');


Route::middleware(['role:customer'])->group(function () {

    Route::get('/userDashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::patch('/updateProfile', [UserDashboardController::class, 'update'])->name('update.profile');
});



Route::middleware(['role:admin,customer'])->group(function () {

    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [AdminDashboardController::class, 'users'])->name('admin.users');
    Route::get('/admin/pitches', [StadiumController::class, 'adminIndex'])->name('admin.pitches');
    Route::post('/users/{user}/toggle-ban', [AdminDashboardController::class, 'toggleBan'])->name('admin.toggle-ban');
    Route::post('/users/manager', [AdminDashboardController::class, 'storeManager'])->name('admin.users.storeManager');
    Route::get('/addStad', [StadiumController::class, 'store'])->name('admin.addStad');
    Route::put('/editStad/{stadium}', [StadiumController::class, 'update'])->name('admin.editStad');
    Route::delete('/removeStad/{stadium}', [StadiumController::class, 'destroy'])->name('admin.removeStad');
});



require_once "Auth.php";
require_once "booking.php";
