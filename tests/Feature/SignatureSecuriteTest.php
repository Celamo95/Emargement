<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Formation;
use App\Models\Cours;
use App\Models\Presence;
use Tests\TestCase;

class SignatureSecuriteTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_apprenant_absent_ne_peut_pas_enregistrer_de_signature(): void
    {
        $formation = Formation::create(['name' => 'BTS SIO SLAM']);

        $apprenant = User::factory()->create([
            'statut' => 'apprenant',
            'formation_id' => $formation->id,
        ]);

        $cours = Cours::create([
            'date' => '2026-06-22',
            'heure_debut' => '09:00:00',
            'heure_fin' => '12:00:00',
            'salle' => 'A1',
            'user_id' => User::factory()->create(['statut' => 'formateur'])->id,
            'formation_id' => $formation->id,
        ]);

        // On crée directement en base une présence où l'apprenant est marqué ABSENT
        // (comme si le formateur avait déjà signé et ne l'avait pas coché)
        Presence::create([
            'cours_id' => $cours->id,
            'apprenant_id' => $apprenant->id,
            'statut' => 'absent',
            'valide_formateur' => true,
        ]);

        // L'apprenant absent essaie quand même d'envoyer une signature directement à l'API
        // (comme s'il contournait l'interface mobile)
        $response = $this->actingAs($apprenant)->post('/api/signature', [
            'signature' => 'data:image/png;base64,FAUXSIGNATURE',
            'cours_id' => $cours->id,
            'user_id' => $apprenant->id,
        ]);

        // On vérifie qu'AUCUNE signature n'a été enregistrée pour cet apprenant absent
        $this->assertDatabaseMissing('presences', [
            'cours_id' => $cours->id,
            'apprenant_id' => $apprenant->id,
            'signature_apprenant' => 'data:image/png;base64,FAUXSIGNATURE',
        ]);
    }
}