<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccueilController extends Controller
{
    public function getCours()
    {
        $totalApprenants = User::where('statut', 'apprenant')->count();
        $totalFormateurs = User::where('statut', 'formateur')->count();
        $totalCours = Cours::count();
        $coursAujourdhui = Cours::whereDate('date', today())->count();

        return view('accueil', compact(
            'totalApprenants',
            'totalFormateurs',
            'totalCours',
            'coursAujourdhui'
        ));
    }
}