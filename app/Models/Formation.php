<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $fillable = ['name'];

    //un user a plusieurs cours
    public function cours()
    {
        return $this->hasMany(Cours::class);
    }

    public function apprenants()
    {
        return $this->hasMany(User::class); // User::class ->va me chercher dans dans le fichier User la class user
    }
}
