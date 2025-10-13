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

namespace Database\Seeders;

use Auth;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use ImetCore\Factories\ProtectedAreaFactory;
use ImetCore\Factories\SpeciesFactory;
use ImetCore\Helpers\Dev\FormSeeder as DevDatabaseSeeder;
use ImetCore\Models\ProtectedArea;
use ImetCore\Models\User\Role;

class DatabaseSeeder extends Seeder
{
    const int NUM_FORMS = 5;

    /**
     * Seed the application's database.
     *
     * @throws Exception
     */
    public function run(): void
    {
        // Add administrator user
        DB::table('users')
            ->insert([
                'id' => 0,
                'first_name' => 'John',
                'last_name' => 'Smith',
                'email' => 'john.smith@email.com',
                'organisation' => 'IMET',
                'function' => 'Developer',
                'imet_role' => Role::ROLE_ADMINISTRATOR,
            ]);

        // Authenticate as administrator
        Auth::loginUsingId(0);

        // Seed protected areas
        ProtectedAreaFactory::new()->count(50)->create();

        // Seed species
        SpeciesFactory::new()->count(1000)->create();

        // Seed forms with modules
        $pas = ProtectedArea::all()->random(10);
        for ($i = 1; $i <= self::NUM_FORMS; $i++) {
            $language = collect(['en', 'fr', 'sp', 'pt'])->random();
            App::setLocale($language);
            DevDatabaseSeeder::seedFormImetV2($pas->random(), $language);
            DevDatabaseSeeder::seedFormImetOecm($pas->random(), $language);
        }

    }
}
