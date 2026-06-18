<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Justificatif;


class ApiJustificatifController extends Controller
{
     public function store(Request $request)
    {
        $request->validate([
            'fichier'     => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
            'presence_id' => ['required', 'integer', 'exists:presences,id'],
        ]);

        // Stocke le fichier dans storage/app/public/justificatifs
        $path = $request->file('fichier')->store('justificatifs', 'public');

        // Crée la ligne en BDD
        Justificatif::create([
            'fichier'     => $path,
            'presence_id' => $request->presence_id,
            'etat'        => 'en_attente',
        ]);

        return response()->json(['status' => 'ok'], 201);
    }
}
