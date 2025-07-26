<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/bookings/{booking}/print', [ThermalPrintController::class, 'printBooking'])
    ->name('bookings.print')
    ->middleware('auth');
