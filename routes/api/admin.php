<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExperienceController;

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
    //experience
    Route::get('experience', [ExperienceController::class, 'index']);
    Route::get('experience/{id}', [ExperienceController::class, 'show']);
    Route::post('experience/{id}', [ExperienceController::class, 'store']);
    Route::put('experience/{id}', [ExperienceController::class, 'update']);
    Route::delete('experience/{id}', [ExperienceController::class, 'delete']);
    //categories
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('categories/{id}', [CategoryController::class, 'show']);
    Route::post('categories/{id}', [CategoryController::class, 'store']);
    Route::put('categories/{id}', [CategoryController::class, 'update']);
    Route::delete('categories/{id}', [CategoryController::class, 'delete']);
});
