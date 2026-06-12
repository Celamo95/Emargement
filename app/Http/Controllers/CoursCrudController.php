<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Cours;
use App\Models\User;

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
            ->get();

        $matieres = Cours::distinct()->pluck('matiere_id');
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
            'matiere'      => ['required', 'string'],
            'date'         => ['required', 'date'],
            'heure_debut'  => ['required'],
            'heure_fin'    => ['required'],
            'salle'        => ['required', 'string'],
            'formation_id' => ['required', 'exists:formations,id'],
            'user_id'      => ['required', 'exists:users,id'],
        ]);

        Cours::create($validate);

        return redirect()->route('emploi-du-temps.index')->with('success', 'Emploi du temps créé avec succès');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
