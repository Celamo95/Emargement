<?php

namespace Database\Seeders;

use App\Models\Cours;
use Illuminate\Database\Seeder;

class CoursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cours::factory()->count(10)->create();
    }
}
