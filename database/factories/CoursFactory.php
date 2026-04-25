<?php

namespace Database\Factories;

use App\Models\Cours;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cours>
 */
class CoursFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $local = 'fr_FR';

        //One bas DateTime for the course start
        $start = fake($local)->dateTimeBetween('-1 year', '+1 year');


        $end = (clone $start)->modify('+' . fake()->numberBetween(120, 240) . 'minutes');

        //Date of validation exist only if he course is validated
        $valide = fake()->boolean();

        //Niveau 1
        if ($valide) {
            $date_validation = (clone $start)->modify('+' . fake()->numberBetween(10, 60) . 'minutes');
        } else {
            $date_validation = null;
        }
        //Niveau 2 $date_validation=$valide? (clone $start)->modify('+'.fake()->numberBetween(10,60). 'minutes'): null;


        return [
            'matiere' => 'Cours de' . fake($local)->word(),
            'date' => $start->format('Y-m-d'),
            'heure_debut' => $start->format('H:i:s'),
            'heure_fin' => $end->format('H:i:s'),
            //'salle' => 'Salle' . fake()->numberBetween(1, 10),
            'date_validation' => $date_validation,
            'valide' => $valide,

        ];
    }
}
