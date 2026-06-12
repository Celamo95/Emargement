<?php

use App\Http\Controllers\Api\CoursController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiSignatureController;
use App\Http\Controllers\Api\ApiProfilController;
use App\Http\Controllers\Api\ApiPasswordController;


Route::post('/auth/login', [ApiAuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('cours', CoursController::class);
    Route::post('/auth/logout', [ApiAuthController::class, 'logout']);
    Route::get('/auth/me', [ApiAuthController::class, 'me']);
    Route::post('/signature', [ApiSignatureController::class, 'store']);
    Route::put('/profil', [ApiProfilController::class, 'update']);
    Route::put('/password', [ApiPasswordController::class, 'update']);    
});
