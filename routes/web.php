<?php

use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StadiumController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/pitches', [StadiumController::class , 'showStadiums'])->name('pitches');  
Route::prefix('manager')->group(function () {
    Route::get('/addStad', [StadiumController::class , 'addStaduim'])->name('manager.addStad');  
    Route::get('/editStad/{stadium}', [StadiumController::class , 'editStaduim'])->name('manager.editStad');  
    Route::get('/removeStad', [StadiumController::class , 'removeStadium'])->name('manager.removeStad');  
});

// Loads the booking page
Route::get('/pitches/{stadium}/book', [ReservationController::class, 'book'])
     ->name('stadium.book');

// Called by JS fetch() to get slots for a specific date
Route::get('/pitches/{stadium}/slots', [ReservationController::class, 'slots'])
     ->name('stadiums.slots');

Route::post('/pitches/{stadium}/reserve', [ReservationController::class, 'store'])->name('reservations.store');


require_once "Auth.php";