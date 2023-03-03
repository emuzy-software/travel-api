<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExperienceController;

Route::prefix('experience')->group(function () {
    Route::get('', [ExperienceController::class, 'index']);
    Route::get('{id}', [ExperienceController::class, 'show']);
});
