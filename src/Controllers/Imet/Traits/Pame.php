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

namespace ImetCore\Controllers\Imet\Traits;


use ImetCore\Controllers\Imet\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

trait Pame{

    public static function pame(Request $request): JsonResponse
    {
        $conditions = [];
        if ($request->filled('iso')) {
            $conditions[] = ['Country', '=', $request->input('iso')];
        }

        $imets = (static::$form_class)
            ::select(['Year as year', 'Country as iso', 'wdpa_id', 'name'])
            ->where($conditions)
            ->get()
            ->sortBy('wdpa_id')
            ->sortBy('iso')
            ->sortBy('year')
            ->toArray();

        return self::sendAPIResponse($imets, $request);
    }

}
