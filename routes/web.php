<?php

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('accueil');
    }
    return view('login');
})->name('login');

Route::post(
    '/login',
    [AuthController::class, 'login']
)->name('login.post');

Route::get(
    '/logout',
    [AuthController::class, 'logout']
)->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/accueil', [AccueilController::class, 'getCours'])->name('accueil');

    Route::get(
        '/me',
        [AuthController::class, 'me']
    )->name('me');
});
