<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use ImetCore\Factories\SpeciesFactory;

class SpeciesSeeder extends Seeder
{
    use WithoutModelEvents;

    const int NUM_MODELS = 1000;

    /**
     * Run the database seeders.
     */
    public function run(?int $num = self::NUM_MODELS): void
    {
        SpeciesFactory::new()
            ->count($num)
            ->create();
    }
}
