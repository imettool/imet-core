<?php
/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

namespace ImetCore\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use ImetCore\Models\Species;

/**
 * Class ProtectedAreaFactory
 * Factory for creating instances of the ProtectedArea model for testing and seeding (ONLY DEV ENVIRONMENT).
 */
class SpeciesFactory extends Factory
{
    protected $model = Species::class;

    public function definition(): array
    {
        return [
            'kingdom' => $this->faker->randomElement(['Animalia', 'Plantae']),
            'phylum' => $this->faker->randomElement(['Chordata', 'Arthropoda', 'Tracheophyta']),
            'class' => $this->faker->randomElement(['Mammalia', 'Aves', 'Insecta', 'Magnoliopsida', 'Pinopsida']),
            'order' => fake()->word(),
            'family' => fake()->word(),
            'genus' => fake()->word(),
            'species' => fake()->word(),
            'authorship' => fake()->name(),
            'col_id' => fake()->bothify('******'),
            'vernacular_names_eng' => fake()->words(2, true) . ', ' . fake()->words(2, true),
            'vernacular_names_spa' => fake()->words(2, true),
            'vernacular_names_fra' => fake()->words(2, true),
        ];
    }
}
