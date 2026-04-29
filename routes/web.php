<?php

use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StadiumController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::prefix('manager')->group(function () {
    Route::get('/addStad', [StadiumController::class, 'addStaduim'])->name('manager.addStad');
    Route::get('/editStad/{stadium}', [StadiumController::class, 'editStaduim'])->name('manager.editStad');
    Route::get('/removeStad', [StadiumController::class, 'removeStadium'])->name('manager.removeStad');
});

Route::get('/pitches', [StadiumController::class, 'showStadiums'])->name('pitches');

// for the booking page
Route::get('/pitches/{stadium}/book', [ReservationController::class, 'book'])->name('stadium.book');

// for fetching depending on the date(when the date changes)
Route::get('/pitches/{stadium}/slots', [ReservationController::class, 'slots'])->name('stadiums.slots');


require_once "Auth.php";
