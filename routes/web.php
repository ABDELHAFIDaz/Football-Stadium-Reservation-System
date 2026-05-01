<?php

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


Route::prefix('manager')->group(function () {

    Route::get('/addStad', [StadiumController::class, 'addStaduim'])->name('manager.addStad');
    Route::get('/editStad/{stadium}', [StadiumController::class, 'editStaduim'])->name('manager.editStad');
    Route::get('/removeStad', [StadiumController::class, 'removeStadium'])->name('manager.removeStad');
})->middleware(['role:manager, admin']);



require_once "Auth.php";
require_once "booking.php";
