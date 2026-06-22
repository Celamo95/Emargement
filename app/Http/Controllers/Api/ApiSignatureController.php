<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Presence;
use Illuminate\Support\Facades\Auth;
use App\Models\Cours;
use App\Models\User;

class ApiSignatureController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'signature' => ['required', 'string'],
            'cours_id'  => ['required', 'integer'],
            'user_id'   => ['nullable', 'integer'],
        ]);

        $user = Auth::user();

        if ($user->statut === 'formateur') {
            // Récupère les apprenants dont la présence a été cochée
            $presencesCochees = $request->input('presences', []);

            // Récupère tous les apprenants de la formation de ce cours
            $cours = \App\Models\Cours::find($validated['cours_id']);
            $apprenants = \App\Models\User::where('statut', 'apprenant')
                ->where('formation_id', $cours->formation_id)
                ->get();

            foreach ($apprenants as $apprenant) {
                // Si l'apprenant est dans la liste des cochés = présent, sinon = absent
                $statut = isset($presencesCochees[$apprenant->id]) ? 'present' : 'absent';

                Presence::updateOrCreate(
                    [
                        'cours_id'     => $validated['cours_id'],
                        'apprenant_id' => $apprenant->id,
                    ],
                    [
                        'statut'               => $statut,
                        'valide_formateur'     => true,
                        'validation_formateur' => now(),
                        'signature_formateur'  => $validated['signature'],
                    ]
                );
            }
        } else {
            // Apprenant — enregistre sa propre signature
            $presence = Presence::firstOrCreate(
                [
                    'cours_id'     => $validated['cours_id'],
                    'apprenant_id' => $user->id, //utilise l'id de l'API web
                ],
                [
                    'valide_formateur'     => true,
                    'valide_apprenant'     => false,
                    'statut'               => 'present',
                    'validation_formateur' => null,
                    'validation_apprenant' => null,
                ]
            );

            // Vérification de sécurité : on n'autorise la signature que si
            // le formateur a validé ET que l'apprenant est marqué présent
            if (! $presence->valide_formateur || $presence->statut !== 'present') {

                return response()->json(['message' => 'Vous ne pouvez pas signer ce cours.'], 403);
            }

            $presence->update([
                'signature_apprenant'  => $validated['signature'],
                'valide_apprenant'     => true,
                'validation_apprenant' => now(),
            ]);
        }

        return response()->json(['status' => 'ok'], 200);
    }

    public function getPresence(int $cours_id)
    {
        $user = Auth::user();

        // Cherche la présence de l'utilisateur connecté pour ce cours
        $presence = Presence::where('cours_id', $cours_id)
            ->where('apprenant_id', $user->id)
            ->first();

        return response()->json($presence);
    }
}
