<?php

namespace Database\Seeders;

use App\Models\Cours;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(5)
            ->has(
                Cours::factory()
                    ->count(5)
            )
            ->create();
    }
}
