<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cours;

class AdminController extends Controller
{
    public function index()
    {
        $totalApprenants = User::where('statut', 'apprenant')->count();
        $totalFormateurs = User::where('statut', 'formateur')->count();
        $totalCours = Cours::count();
        $coursAujourdhui = Cours::whereDate('date', today())->count();

        return view('admin.dashboard', compact(
            'totalApprenants',
            'totalFormateurs',
            'totalCours',
            'coursAujourdhui'
        ));
    }
}