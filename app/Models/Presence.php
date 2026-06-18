<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\Cours;
use App\Models\Justificatif;


class Presence extends Model
{
    protected $fillable = [
        'valide_formateur',
        'valide_apprenant',
        'validation_formateur',
        'validation_apprenant',
        'formateur_id',
        'apprenant_id',
        'cours_id',
        'signature_formateur',
        'signature_apprenant',
        'statut',
    ];
    public function formateur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'formateur_id');
    }
    public function apprenant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'apprenant_id');
    }
    public function cours(): BelongsTo
    {
        return $this->belongsTo(Cours::class, 'cours_id');
    }
    public function justificatifs(): HasMany
{
    return $this->hasMany(Justificatif::class, 'presence_id');
}
}
