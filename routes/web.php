<?php

use App\Http\Controllers\AccueilController;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/auth/', function () {
    return view('login');
})->name('login');

Route::get('/accueil', [AccueilController::class,'getCours'])->name('accueil');