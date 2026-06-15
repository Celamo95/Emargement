<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ApiApprenantController extends Controller

{
    public function index(Request $request)
    {
        // Récupère les apprenants de la formation demandée
        $apprenants = User::where('statut', 'apprenant')
            ->where('formation_id', $request->formation_id)
            ->get();

        return response()->json($apprenants);
    }
}

