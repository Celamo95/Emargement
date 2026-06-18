<?php

use App\Http\Controllers\Api\CoursController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiSignatureController;
use App\Http\Controllers\Api\ApiProfilController;
use App\Http\Controllers\Api\ApiPasswordController;
use App\Http\Controllers\Api\ApiApprenantController;
use App\Http\Controllers\Api\ApiJustificatifController;




Route::post('/auth/login', [ApiAuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('cours', CoursController::class);
    Route::post('/auth/logout', [ApiAuthController::class, 'logout']);
    Route::get('/auth/me', [ApiAuthController::class, 'me']);
    Route::post('/signature', [ApiSignatureController::class, 'store']);
    Route::put('/profil', [ApiProfilController::class, 'update']);
    Route::put('/password', [ApiPasswordController::class, 'update']); 
    Route::get('/apprenants', [ApiApprenantController::class, 'index']);
    Route::get('/presence/{cours_id}', [ApiSignatureController::class, 'getPresence']);
    Route::post('/justificatif', [ApiJustificatifController::class, 'store']);

   
});
