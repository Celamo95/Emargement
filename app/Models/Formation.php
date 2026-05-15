<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Formation extends Model
{
    protected $fillable = ['name'];

    public function cours(): HasMany
    {
        return $this->hasMany(Cours::class);
    }

    public function apprenants(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function participations(): HasMany
    {
        return $this->hasMany(Participation::class);
    }
}
