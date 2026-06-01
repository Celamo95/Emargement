<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate request
        $credentials = $request->validate([
            'email'    => ['required', 'email'], // Ou username au choix
            'password' => ['required'],
        ]);


        if (! Auth::attempt($credentials)) {
            return redirect()
                ->route('login')
                ->with('error', 'Email ou mot de passe incorrect.');
        }


        // Regenerate session to prevent fixation
        $request->session()->regenerate();

        $statut = Auth::user()->statut;

        if ($statut === 'administration') {
            return redirect()->route('accueil');
        }

        return redirect()->route('mobile');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Déconnexion réussie.');
    }

    public function me(Request $request)
    {
        return response()->json([
            'user' => $request->user(),
        ]);
    }
}
