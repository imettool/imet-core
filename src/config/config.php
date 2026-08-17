<?php

use ImetCore\Models\User\User;

/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

return [

    // Models class references: allow overriding default models
    'user' => User::class,

    // Routes' prefixes
    'web_routes_prefix' => null,
    'api_routes_prefix' => null,

    // CSV sample files: populate protected areas and species tables with data from CSVs if provided
    'csv_sample_files' => [
        'protected_areas' => env('CSV_PROTECTED_AREAS_SAMPLE_FILE', null),
        'species' => env('CSV_SPECIES_SAMPLE_FILE', null),
        'vernacular_names' => env('CSV_VERNACULAR_NAMES_SAMPLE_FILE', null),
    ],

];
