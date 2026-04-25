<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;

    protected $fillable = [
        'matiere',
        'date',
        'heure_debut',
        'heure_fin',
        'salle',
        'valide',
        'date_validation',
    ];
}
