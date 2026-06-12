<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Matiere;
use App\Models\Cours;
use Illuminate\Support\Facades\DB;

class FormationsCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formations = Formation::all();
        $matieres = Matiere::with('user')->get();
        return view('formations.index', compact('formations', 'matieres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $matieres = Matiere::all();
        return view('formations.create', compact('matieres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validate = $request->validate([
            'name' => ['required', 'string'],
        ]);

        // On récupère la formation créée pour avoir son id
        $formation = Formation::create([
            'name' => $request->name,
        ]);

        // Si des cours ont été sélectionnés on les lie à la formation
        if ($request->has('matieres')) {
            foreach ($request->matieres as $matiereId) {
                DB::table('formation_matiere')->insert([
                    'formation_id' => $formation->id,
                    'matiere_id'     => $matiereId,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);
            }
        }

        return redirect()->route('formations.index')->with('success', 'Formations créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $formation = Formation::find($id);

        $matiereIds = DB::table('formation_matiere')
            ->where('formation_id', $id)
            ->pluck('matiere_id')
            ->toArray();

        $matieres = Matiere::whereIn('id', $matiereIds)->get();

        return view('formations.show', compact('formation', 'matieres'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $formation = Formation::find($id);
        $matieres = Matiere::all();

        $matieresLiees = DB::table('formation_matiere')
            ->where('formation_id', $id)
            ->pluck('matiere_id')
            ->toArray();

        return view('formations.update', compact('formation', 'matieres', 'matieresLiees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name' => ['required', 'string'],
        ]);

        Formation::whereId($id)->update($validate);

        DB::table('formation_matiere')->where('formation_id', $id)->delete();

        if ($request->has('matieres')) {
            foreach ($request->matieres as $matiereId) {
                DB::table('formation_matiere')->insert([
                    'formation_id' => $id,
                    'matiere_id'   => $matiereId,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);
            }
        }

        return redirect()->route('formations.index')->with('success', 'Formation modifiée');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $formation = Formation::findOrFail($id);
        $formation->delete();

        return redirect(route('formations.index'));
    }
}
