<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_formateur_peut_se_connecter_avec_les_bons_identifiants(): void
    {
        // On crée un utilisateur de test, avec un mot de passe qu'on connaît
        $user = User::factory()->create([
            'email' => 'formateur.test@gefor.fr',
            'password' => bcrypt('motdepasse123'),
            'statut' => 'formateur',
        ]);

        // On essaie de se connecter avec les bons identifiants
        $response = $this->post('/login', [
            'email' => 'formateur.test@gefor.fr',
            'password' => 'motdepasse123',
        ]);

        // On vérifie que l'utilisateur est bien authentifié
        $this->assertAuthenticatedAs($user);
    }

    public function test_la_connexion_echoue_avec_un_mauvais_mot_de_passe(): void
    {
        User::factory()->create([
            'email' => 'formateur.test@gefor.fr',
            'password' => bcrypt('motdepasse123'),
            'statut' => 'formateur',
        ]);

        $response = $this->post('/login', [
            'email' => 'formateur.test@gefor.fr',
            'password' => 'mauvais_mot_de_passe',
        ]);

        // On vérifie que personne n'est authentifié
        $this->assertGuest();
    }
}