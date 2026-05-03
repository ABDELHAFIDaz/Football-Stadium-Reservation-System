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

    Route::get('/userDashboard', [UserDashboardController::class, 'index'])->name('user.dashboard')->middleware(['role:customer']);
    Route::patch('/updateProfile', [UserDashboardController::class, 'update'])->name('update.profile')->middleware(['role:customer']);
});


Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/users', [AdminDashboardController::class, 'users'])->name('admin.users');
Route::post('/users/{user}/toggle-ban', [AdminDashboardController::class, 'toggleBan'])->name('admin.toggle-ban');
Route::middleware(['role:admin'])->group(function () {


    Route::get('/addStad', [StadiumController::class, 'addStaduim'])->name('admin.addStad');
    Route::get('/editStad/{stadium}', [StadiumController::class, 'editStaduim'])->name('admin.editStad');
    Route::get('/removeStad', [StadiumController::class, 'removeStadium'])->name('admin.removeStad');
});



require_once "Auth.php";
require_once "booking.php";
