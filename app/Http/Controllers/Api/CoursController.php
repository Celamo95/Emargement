<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if (
            $user->statut === 'formateur'
        ) {
            $cours = Cours::with(['user', 'matiere'])
                ->join('formations', 'cours.formation_id', '=', 'formations.id')
                ->select('cours.*', 'formations.name as formation_name')
                ->whereDate('date', '>=', now()->subDays(7)->toDateString())
                ->where('cours.user_id', $user->id)
                ->orderBy('date')
                ->orderBy('heure_debut')
                ->get();
        } elseif ($user->statut === 'apprenant') {
            $cours = Cours::with(['user', 'matiere'])
                ->whereDate('date', '>=', now()->subDays(7)->toDateString())
                ->where('formation_id', $user->formation_id)
                ->orderBy('date')
                ->orderBy('heure_debut')
                ->get();
        } else {
            $cours = Cours::with(['user', 'matiere',])
                ->whereDate('date', '>=', now()->SubDays(7)->toDateString())
                ->orderBy('date')
                ->orderBy('heure_debut')
                ->get();
        }
        return response()->json($cours);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'matiere' => ['require', 'string', 'max:255'],
            'date' => ['require', 'date_format:Y-m-d'],
            'heure_debut' => ['require', 'date_format:H:i'],
            'heure_fin' => ['require', 'date_format:H:i'],
            'salle' => ['require', 'string', 'max:255'],
            'user_id' => ['require', 'exists:users,id'],
        ]);

        Cours::created($validate);

        return response()->json(true, status: 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {

        $cours = Cours::with(['user', 'matiere', 'formation'])->find($id);
        return response()->json($cours);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cours $cours)
    {
        $validate = $request->validate([
            'matiere' => ['require', 'string', 'max:255'],
            'date' => ['require', 'date_format:Y-m-d'],
            'heure_debut' => ['require', 'date_format:H:i'],
            'heure_fin' => ['require', 'date_format:H:i'],
            'salle' => ['require', 'string', 'max:255'],
            'user_id' => ['require', 'exists:users,id'],
        ]);

        $cours->update($validate);

        return response()->json($cours);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $cours = Cours::find($id, 'id');
        $cours->delete($id);

        return response()->json([
            'message' => 'Cours supprimé'
        ]);
    }
}
