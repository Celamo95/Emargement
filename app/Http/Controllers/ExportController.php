<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Presence;

class ExportController extends Controller
{
     public function show(int $apprenant_id, string $mois)
    {
        // $mois au format "2026-06" par exemple
        $apprenant = User::findOrFail($apprenant_id);

        // Récupère toutes les présences de l'apprenant pour ce mois
        $presences = Presence::with(['cours.matiere'])
            ->where('apprenant_id', $apprenant_id)
            ->whereHas('cours', function ($query) use ($mois) {
                $query->whereYear('date', substr($mois, 0, 4))
                      ->whereMonth('date', substr($mois, 5, 2));
            })
            ->get();

        return view('export.show', compact('apprenant', 'presences', 'mois'));
    }

    public function create()
{
    $apprenants = User::where('statut', 'apprenant')->get();
    return view('export.create', compact('apprenants'));
}
}
