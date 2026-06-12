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

        $formations = Formation::with('cours')->get();
        $matieres = Matiere::with('user')->get();
        return view('formations.index', compact('formations', 'matieres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cours = Cours::all();

        return view('formations.create', compact('cours'));
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
        if ($request->has('cours')) {
            foreach ($request->cours as $coursId) {
                DB::table('participation')->insert([
                    'formation_id' => $formation->id,
                    'cours_id'     => $coursId,
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
        $formation = Formation::Find($id);

        $coursLies = DB::table('participation')
            ->where('formation_id', $id)
            ->pluck('cours_id')
            ->toArray();

        $cours = Cours::whereIn('id', $coursLies)->get();

        return view('formations.show', compact('formation', 'cours', 'coursLies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $formation = Formation::find($id);
        $cours = Cours::all();

        // Récupère les ids des cours déjà liés à cette formation

        $coursLies = DB::table('participation')
            ->where('formation_id', $id)
            ->pluck('cours_id')
            ->toArray();

        return view('formations.update', compact('formation', 'cours', 'coursLies'));
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

        // Supprime tous les cours liés à cette formation
        DB::table('participation')->where('formation_id', $id)->delete();

        // Réinsère les nouveaux cours sélectionnés
        if ($request->has('cours')) {
            foreach ($request->cours as $coursId) {
                DB::table('participation')->insert([
                    'formation_id' => $id,
                    'cours_id'     => $coursId,
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
