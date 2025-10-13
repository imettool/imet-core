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
use ImetCore\Models\ProtectedArea;
use ModularForms\Controllers\Controller;

class ProtectedAreaController extends Controller
{
    /**
     * Search by search string or country
     */
    public static function search(Request $request): JsonResponse
    {
        $list = collect();
        if ($request->filled('search_key') || $request->filled('country')) {
            $list = ProtectedArea::searchByKeyOrCountry(
                $request->input('search_key'),
                $request->input('country'));
        }

        return static::sendAPIResponse($list->toArray(), null, 200, [
            'countries' => $list->pluck('country_name', 'country')
                ->sort()
                ->toArray(),
        ]);
    }

    /**
     *  Get list of pairs of id/label as JSON
     */
    public static function get_labels(Request $request): JsonResponse
    {
        $pairs = [];

        if ($request->filled('id')) {

            // Retrieve IDs list: can be comma separated string or json array
            $ids = $request->input('id');
            if (is_int($ids)) {
                $pas = [$ids];  // force array if single integer
            } else {
                $pas = json_validate($ids)
                    ? json_decode($ids)
                    : explode(',', $ids);
            }

            $pairs = ProtectedArea::query()->select(['wdpa_id', 'name'])
                ->whereIn('wdpa_id', $pas)
                ->get();
        }

        return static::sendAPIResponse($pairs);
    }
}
