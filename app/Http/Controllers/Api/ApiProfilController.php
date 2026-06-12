<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiProfilController extends Controller
{
    // Met à jour le profil de l'utilisateur connecté
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'      => ['required', 'string'],
            'firstname' => ['required', 'string'],
            'email'     => ['required', 'email'],
        ]);

        $user->update([
            'name'      => $request->name,
            'firstname' => $request->firstname,
            'email'     => $request->email,
        ]);

        return response()->json($user);
    }
}