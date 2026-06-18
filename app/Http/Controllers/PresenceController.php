<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presence;
use App\Models\Formation;
use App\Models\Cours;
use App\Models\Justificatif;

class PresenceController extends Controller
{
    public function index(Request $request)
    {

        $formations = Formation::all();
        $cours = collect();

        if ($request->filled('cours_id')) {
            $presences = Presence::with(['apprenant', 'justificatifs', 'cours.matiere'])
                ->where('cours_id', $request->cours_id)
                ->get();
        } else {
            // Par défaut — toutes les absences récentes
            $presences = Presence::with(['apprenant', 'justificatifs', 'cours.matiere'])
                ->where('statut', 'absent')
                ->orderBy('created_at', 'desc')
                ->get();
        }
        // Si une formation est sélectionnée, récupère ses cours
        if ($request->filled('formation_id')) {
            $cours = Cours::where('formation_id', $request->formation_id)
                ->orderBy('date', 'desc')
                ->get();
        }

        // Si un cours est sélectionné, filtre les présences
        if ($request->filled('cours_id')) {
            $presences = Presence::with(['apprenant', 'justificatifs', 'cours.matiere'])
                ->where('cours_id', $request->cours_id)
                ->get();
        }

        return view('presences.index', compact('formations', 'cours', 'presences'));
    }

    public function updateJustificatif(Request $request, int $id)
    {
        $justificatif = Justificatif::findOrFail($id);
        $justificatif->update([
            'etat' => $request->etat,
            'validation_administration' => now(),
        ]);

        return redirect()->back()->with('success', 'Justificatif mis à jour.');
    }
}
