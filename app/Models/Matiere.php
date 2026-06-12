<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Matiere extends Model
{
    protected $fillable = ['nom', 'user_id'];

    // Une matière appartient à un formateur
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Une matière peut avoir plusieurs séances (cours)
    public function cours(): HasMany
    {
        return $this->hasMany(Cours::class);
    }
}