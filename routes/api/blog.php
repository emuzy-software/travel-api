<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

Route::prefix('blog')->group(function () {
    Route::get('', [BlogController::class, 'index']);
    Route::get('{id}', [BlogController::class, 'show']);
});
