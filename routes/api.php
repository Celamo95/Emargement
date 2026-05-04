<?php

use App\Http\Controllers\Api\CoursController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;


Route::post('/auth/login', [ApiAuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('cours', CoursController::class);
    Route::post('/auth/logout', [ApiAuthController::class, 'logout']);
    Route::get('/auth/me', [ApiAuthController::class, 'me']);
});
