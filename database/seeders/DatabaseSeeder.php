<?php

namespace Database\Seeders;

use App\Models\Cours;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin1@formapp.fr',
            'password' => bcrypt('Administrateur#51'),
            'statut' => 'administration',
        ]);

        User::factory()->create([
            'name' => 'Formateur',
            'email' => 'formateur1@formapp.fr',
            'password' => bcrypt('Formateur#29'),
            'statut' => 'formateur',
        ]);

        User::factory()->create([
            'name' => 'Apprenant',
            'email' => 'apprenant1@formapp.fr',
            'password' => bcrypt('Apprenant#74'),
            'statut' => 'apprenant',
        ]);

        Cours::factory(2)->create();
    }
}
