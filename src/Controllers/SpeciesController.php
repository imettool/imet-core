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

namespace ImetCore\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use ImetCore\Models\Species;
use ModularForms\Controllers\Controller;
use ModularForms\Helpers\HTTP;

class SpeciesController extends Controller
{
    /**
     * Search Species by key
     */
    public static function search(Request $request): JsonResponse
    {
        $species = collect();
        $ordersByClass = [];

        // Perform search only if search_key provided
        if ($request->filled('search_key')) {

            HTTP::sanitize($request, [
                'search' => 'alpha|nullable',
            ]);

            // Perform search query
            $species = Species::searchSpecies($request->input('search_key'));

            // Organize order by classes
            $ordersByClass = $species
                ->map->only(['class', 'order'])
                ->unique()
                ->sortBy('order')
                ->sortBy('class')
                ->mapToGroups(fn (array $item): array => [$item['class'] => $item['order']])
                ->toArray();
        }

        return static::sendAPIResponse($species->toArray(), null, 200, [
            'classes' => array_keys($ordersByClass),
            'orders' => $ordersByClass,
        ]);
    }

    public static function info(Request $request): \Illuminate\Http\JsonResponse
    {
        $species = null;

        if ($request->filled('taxonomy')) {

//            HTTP::sanitize($request, [
//                'taxonomy' => 'alpha',
//            ]);

            // Perform search query
            $species = Species::getByTaxonomy($request->input('taxonomy'));

        }

        return static::sendAPIResponse($species, null, 200);
    }

}
