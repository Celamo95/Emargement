<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Cours;
use App\Models\User;
use App\Models\Matiere;

class CoursCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Récupère la date de début de semaine — par défaut la semaine en cours
        // $request->week permet de naviguer vers d'autres semaines
        $debutSemaine = $request->filled('week')
            ? \Carbon\Carbon::parse($request->week)->startOfWeek()
            : \Carbon\Carbon::now()->startOfWeek();

        $finSemaine = $debutSemaine->copy()->endOfWeek();

        // Récupère uniquement les cours de cette semaine
        $cours = Cours::with(['user', 'matiere'])
            ->whereBetween('date', [$debutSemaine, $finSemaine])
            ->when($request->filled('formation_id'), function ($query) use ($request) {
                $query->where('formation_id', $request->formation_id);
            })
            ->get();

        $matieres = Matiere::with(['user', 'formations'])->get();
        $formateurs = User::where('statut', 'formateur')->get();
        $formations = Formation::all();

        return view('cours.index', compact('cours', 'matieres', 'formateurs', 'formations', 'debutSemaine'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validate = $request->validate([
            'matiere_id'      => ['required', 'string'],
            'date'         => ['required', 'date'],
            'heure_debut'  => ['required'],
            'heure_fin'    => ['required'],
            'salle'        => ['required', 'string'],
            'formation_id' => ['required', 'exists:formations,id'],
            'user_id'      => ['required', 'exists:users,id'],
        ]);

        Cours::create($validate);

        return redirect()->route('emploi-du-temps.index', [
            'week' => $request->date,
            'formation_id' => $request->formation_id,
        ])->with('success', 'Cours ajouté');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Récupère le cours à modifier
        $cours = Cours::find($id);

        // Récupère les listes pour les selects

        // Récupère uniquement les matières liées à la formation de ce cours
        $matieres = Matiere::whereHas('formations', function ($query) use ($cours) {
            $query->where('formations.id', $cours->formation_id);
        })->get();
        $formateurs = User::where('statut', 'formateur')->get();
        $formations = Formation::all();

        return view('cours.update', compact('cours', 'matieres', 'formateurs', 'formations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'formation_id' => ['required', 'exists:formations,id'],
            'matiere_id'   => ['required', 'exists:matieres,id'],
            'date'         => ['required', 'date'],
            'heure_debut'  => ['required'],
            'heure_fin'    => ['required'],
            'salle'        => ['required', 'string'],
            'user_id'      => ['required', 'exists:users,id'],
        ]);

        Cours::whereId($id)->update($validate);

        return redirect()->route('emploi-du-temps.index', [
            'week' => $request->date,
            'formation_id' => $request->formation_id,
        ])->with('success', 'Cours modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cours = Cours::findOrFail($id);
        $cours->delete();

        return redirect(route('emploi-du-temps.index'));
    }
}
