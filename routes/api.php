<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\BookingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

require __DIR__ . '/api/booking.php';
require __DIR__ . '/api/blog.php';
Route::post('sign-up', [AuthController::class, 'signUp']);
Route::post('login', [AuthController::class, 'login']);
Route::get('categories', [CategoryController::class, 'index']);
Route::group(['middleware' => ['auth:api']], function () {
    Route::post('refresh-token', [AuthController::class, 'refreshToken']);

    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('booking', [BookingController::class, 'store']);
    Route::get('info', [UserController::class, 'info']);
});
