<?php

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersCrudController;
use App\Http\Controllers\FormationsCrudController;
use App\Http\Controllers\CoursCrudController;
use App\Http\Controllers\MatieresCrudController;
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

// Affiche le formulaire de création du mot de passe
Route::get('/set-password', [UsersCrudController::class, 'setPasswordForm'])->name('set.password.form');

// Enregistre le nouveau mot de passe
Route::post('/set-password', [UsersCrudController::class, 'setPassword'])->name('set.password');

Route::middleware('auth')->group(function () {

    Route::get('/accueil', [AccueilController::class, 'getCours'])->name('accueil');

    Route::get('/me', [AuthController::class, 'me'])->name('me');

    //Users

    Route::get('/Users/{id}/delete', [UsersCrudController::class, 'delete'])->name('user.delete');

    Route::get('/Users', [UsersCrudController::class, 'index'])->name('users.index');

    Route::get('/Users/create', [UsersCrudController::class, 'create'])->name('user.create');

    Route::post('/Users', [UsersCrudController::class, 'store'])->name('user.store');

    Route::get('/Users/{id}/edit', [UsersCrudController::class, 'edit'])->name('user.edit');

    Route::put('/Users/{id}', [UsersCrudController::class, 'update'])->name('user.update');

    Route::get('/Users/{id}', [UsersCrudController::class, 'show'])->name('user.show');

    //Formation

    Route::resource('formations', FormationsCrudController::class); //Génère les 7 routes automatiquement

    //Cours

    Route::resource('emploi-du-temps', CoursCrudController::class);

    //Matieres
    Route::resource('matieres', MatieresCrudController::class);
});
