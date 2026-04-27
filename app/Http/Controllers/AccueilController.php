<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use Illuminate\Http\Request;

class AccueilController extends Controller
{
    public function getCours()
    {
        $cours = Cours::with(['user'])
            ->whereDate('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->orderBy('heure_debut')
            ->get();

        return view('accueil', ['cours' => $cours]);
    }
}
