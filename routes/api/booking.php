<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;


Route::post('booking', [BookingController::class, 'store']);
