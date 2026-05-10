<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Presence;


class ApiSignatureController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'signature' => ['required', 'string'],
            'cours_id'  => ['required', 'integer'],
            'user_id'   => ['nullable', 'integer'],
        ]);

        /*$presence = Presence::where('cours_id', $validated['cours_id'])
            ->where('apprenant_id', $validated['user_id'])
            ->first();

        if (!$presence) {
            return response()->json([
                'status' => 'error',
                'message' => 'Présence non trouvée.',
            ], 404);
        }*/
        $presence = Presence::firstOrCreate(
            [
                'cours_id'     => $validated['cours_id'],
                'apprenant_id' => $validated['user_id'],
            ],
            [
                'valide_formateur' => false,
                'valide_apprenant' => false,
                'statut'           => 'absent',
                'validation_formateur'  => null,
                'validation_apprenant'  => null,
                'formateur_id'          => null,
            ]
        );

        $presence->update([
            'signature'          => $validated['signature'],
            'valide_apprenant'   => true,
            'validation_apprenant' => now(),
        ]);

        return response()->json([
            'status' => 'ok',
            'presence_id' => $presence->id,
        ], 200);
    }
}
