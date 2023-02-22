<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

Route::get('booking', [BookingController::class, 'index']);

Route::post('booking', [BookingController::class, 'store']);
