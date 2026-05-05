<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Semestre;

class SemestreSeeder extends Seeder
{
    public function run(): void
    {
        $semestres = ['S5', 'S6', 'S7', 'S8', 'S9', 'S10'];

        foreach ($semestres as $semestre) {
            Semestre::updateOrCreate(
                ['nom' => $semestre],
                ['nom' => $semestre]
            );
        }
    }
}