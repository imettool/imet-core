<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use ImetCore\Factories\ProtectedAreaFactory;

class ProtectedAreaSeeder extends Seeder
{
    use WithoutModelEvents;

    const int NUM_MODELS = 50;

    /**
     * Run the database seeders.
     */
    public function run(?int $num = self::NUM_MODELS): void
    {
        ProtectedAreaFactory::new()
            ->count($num)
            ->create();
    }
}
