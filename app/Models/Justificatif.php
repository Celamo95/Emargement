<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Presence;

class Justificatif extends Model
{

    protected $fillable = [
        'fichier',
        'etat',
        'validation_administration',
        'presence_id',

    ];

    public function presence(): BelongsTo
    {
        return $this->belongsTo(Presence::class, 'presence_id');
    }
}
