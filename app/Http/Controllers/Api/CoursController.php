<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cours;
use Illuminate\Http\Request;

class CoursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cours=Cours::whereDate('date','>=',now()->toDateString())
        ->orderBy('date')
        ->orderBy('heure_debut')
        ->get();

        return response()->json($cours);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate=$request->validate([
            'matiere'=>['require','string','max:255'],
            'date'=>['require','date_format:Y-m-d'],
            'heure_debut'=>['require','date_format:H:i'],
            'heure_fin'=>['require','date_format:H:i'],
            'salle'=>['require','string','max:255'],
             ]);
        
             $cours=Cours::created($validate);

             return response()->json($cours, status:201);

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $cours=Cours::find($id);

        return response()->json($cours);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cours $cours)
    {
         $validate=$request->validate([
            'matiere'=>['require','string','max:255'],
            'date'=>['require','date_format:Y-m-d'],
            'heure_debut'=>['require','date_format:H:i'],
            'heure_fin'=>['require','date_format:H:i'],
            'salle'=>['require','string','max:255'],
             ]);

             $cours->update($validate);

             return response()->json($cours);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cours $cours)
    {
        $cours->delete();

        return response()->json([
            'message'=>'Cours supprimé'
            ]);
    }
}
