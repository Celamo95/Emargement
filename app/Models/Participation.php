<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    protected $table = 'participation';

    protected $fillable = [
        'formation_id',
        'cours_id',
    ];

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function cours()
    {
        return $this->belongsTo(Cours::class);
    }
}
