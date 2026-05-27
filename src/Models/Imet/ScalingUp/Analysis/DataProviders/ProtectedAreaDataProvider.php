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

namespace ImetCore\Models\Imet\ScalingUp\Analysis\DataProviders;

use ImetCore\Models\Country;
use ImetCore\Models\Imet\ScalingUp\ScalingUpWdpa;

final readonly class ProtectedAreaDataProvider extends BaseDataProvider
{

    /**
     * @throws \Exception
     */
    public function getProtectedAreasWithCountries(array $formIds): array
    {
        $items = array_map(function (int $formId): array {
            $pa = ScalingUpWdpa::getCustomNames($formId, $this->getScalingId());

            return [
                ...$pa->toArray(),
                'Country_name' => Country::getByISO($pa['Country']),
            ];
        }, $formIds);

        uasort($items, fn (array $a, array $b): int => strnatcmp((string) $a['name'], (string) $b['name']));

        return $items;
    }
}
