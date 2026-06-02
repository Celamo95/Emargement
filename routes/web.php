<?php

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersCrudController;
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

Route::get('/mobile', function () {
    return view('mobile');
})->name('mobile');

Route::middleware('auth')->group(function () {


    Route::get('/accueil', [AccueilController::class, 'getCours'])->name('accueil');

    Route::get('/me', [AuthController::class, 'me'])->name('me');

    Route::get('/Users/{id}/delete', [UsersCrudController::class, 'delete'])->name('users.delete');

    Route::get('/Users', [UsersCrudController::class, 'index'])->name('users.index');

    Route::get('/Users/create', [UsersCrudController::class, 'create'])->name('user.create');

    Route::post('/Users', [UsersCrudController::class, 'store'])->name('user.store');
});
