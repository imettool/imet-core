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

use Illuminate\Database\Seeder;
use ImetCore\Models\Imet\Imet;
use Throwable;

class DatabaseSeeder extends Seeder
{
    const int NUM_FORMS = 5;

    /**
     * Seed the application's database.
     *
     * @throws Throwable
     */
    public function run(): void
    {
        // Seed admin user and login
        (new UserSeeder)->run();

        // Seed protected areas
        (new ProtectedAreaSeeder)->runWithSample();

        // Seed species
        (new SpeciesSeeder)->runWithSample();

        // Seed forms with modules
        (new FormSeeder)->run(Imet::IMET_V1, self::NUM_FORMS);
        (new FormSeeder)->run(Imet::IMET_V2, self::NUM_FORMS);
        (new FormSeeder)->run(Imet::IMET_OECM, self::NUM_FORMS);

    }
}
