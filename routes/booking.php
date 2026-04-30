<?php

use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;


Route::middleware(['role:customer'])->group(function () {

    // for the booking page
    Route::get('/pitches/{stadium}/book', [ReservationController::class, 'book'])->name('stadium.book');

    // for fetching depending on the date(when the date changes)
    Route::get('/pitches/{stadium}/slots', [ReservationController::class, 'slots'])->name('stadium.slots');

    Route::post('/pitches/{stadium}/reserve', [ReservationController::class, 'store'])->name('reservation.store');
});