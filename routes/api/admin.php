<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookingController;

Route::prefix('admin')->group(function () {
    //blog
    Route::get('blog', [BlogController::class, 'index']);
    Route::get('blog/{id}', [BlogController::class, 'show']);
    Route::post('blog', [BlogController::class, 'store']);
    Route::put('blog/{id}', [BlogController::class, 'update']);
    Route::delete('blog/{id}', [BlogController::class, 'destroy']);
    //booking
    Route::get('booking', [BookingController::class, 'index']);
    Route::get('booking/{id}', [BookingController::class, 'show']);
    Route::put('booking/{id}', [BookingController::class, 'update']);
    Route::delete('booking/{id}', [BookingController::class, 'destroy']);
});
