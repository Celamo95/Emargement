<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Formation;
use App\Models\Cours;
use Tests\TestCase;

class PresenceTest extends TestCase
{
    use RefreshDatabase;

    public function test_le_formateur_peut_marquer_des_apprenants_presents_et_absents(): void
    {
        // On crée une formation de test
        $formation = Formation::create(['name' => 'BTS SIO SLAM']);

        // On crée un formateur de test
        $formateur = User::factory()->create([
            'statut' => 'formateur',
            'firstname' => 'Jean',
        ]);

        // On crée deux apprenants dans cette même formation
        $apprenantPresent = User::factory()->create([
            'statut' => 'apprenant',
            'firstname' => 'Marie',
            'formation_id' => $formation->id,
        ]);
        $apprenantAbsent = User::factory()->create([
            'statut' => 'apprenant',
            'firstname' => 'Paul',
            'formation_id' => $formation->id,
        ]);

        // On crée un cours pour cette formation, donné par ce formateur
        $cours = Cours::create([
            'date' => '2026-06-22',
            'heure_debut' => '09:00:00',
            'heure_fin' => '12:00:00',
            'salle' => 'A1',
            'user_id' => $formateur->id,
            'formation_id' => $formation->id,
        ]);

        // Le formateur signe : seul l'apprenant "présent" est coché dans le formulaire
        $response = $this->actingAs($formateur)->post('/api/signature', [
            'signature' => 'data:image/png;base64,FAUXSIGNATURE',
            'cours_id' => $cours->id,
            'presences' => [
                $apprenantPresent->id => 'present',
            ],
        ]);

        // On vérifie directement en base de données que les statuts sont corrects
        $this->assertDatabaseHas('presences', [
            'cours_id' => $cours->id,
            'apprenant_id' => $apprenantPresent->id,
            'statut' => 'present',
        ]);

        $this->assertDatabaseHas('presences', [
            'cours_id' => $cours->id,
            'apprenant_id' => $apprenantAbsent->id,
            'statut' => 'absent',
        ]);
    }
}