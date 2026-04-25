<?php

use App\Http\Controllers\Api\CoursController;
use Illuminate\Support\Facades\Route;

Route::apiResource('cours',CoursController::class);
