<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Matiere;

class MatieresCrudController extends Controller
{
    public function index()
    {
        // gérer par FormationsCrudController
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $formateurs = User::where('statut', 'formateur')->get();
        return view('matieres.create', compact('formateurs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validate = $request->validate([
            'nom' => ['required', 'string'],
            'user_id' => ['required', 'exists:users,id'],
        ]);
        // dd($validate);

        Matiere::create($validate);

        return redirect()->route('formations.index')->with('success', 'Matière créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $matiere = Matiere::Find($id);

        return view('matieres.show', compact('matiere'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $matiere = Matiere::find($id);
        $formateurs = User::where('statut', 'formateur')->get();

        return view('matieres.update', compact('matiere', 'formateurs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'nom' => ['required', 'string'],
            'user_id' => ['required', 'exists:users,id'],

        ]);

        Matiere::whereId($id)->update($validate);

        return redirect()->route('formations.index')->with('success', 'Matière modifiée');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $matiere = Matiere::findOrFail($id);
        $matiere->delete();

        return redirect(route('formations.index'));
    }
}
