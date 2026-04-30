<?php

use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StadiumController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

// just for testing 
Route::get('/userDashboard', function () {
    return view('userDashboard');
})->name('user.dashboard');

Route::prefix('manager')->group(function () {
    Route::get('/addStad', [StadiumController::class, 'addStaduim'])->name('manager.addStad');
    Route::get('/editStad/{stadium}', [StadiumController::class, 'editStaduim'])->name('manager.editStad');
    Route::get('/removeStad', [StadiumController::class, 'removeStadium'])->name('manager.removeStad');
});

Route::get('/pitches', [StadiumController::class, 'showStadiums'])->name('pitches');





require_once "Auth.php";
require_once "booking.php";