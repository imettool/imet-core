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

namespace ImetCore\Services\Scores\Functions;

use ImetCore\Models\Imet\Components\Modules\ImetModule;

trait CommonFunctions
{
    /**
     * Standard function for TABLE type modules
     */
    protected static function score_table(int $imet_id, $module_class, string $module_field, int $denominator = 3): ?float
    {
        $records = $module_class::getModule($imet_id);
        $values = $records
            ->pluck($module_field)
            ->filter(fn ($value): bool => $value != -99)
            ->toArray();

        $average = static::average($values, null);
        $score = $average !== null ? $average / $denominator * 100 : null;

        return $score !== null ?
            round($score, 2)
            : null;
    }

    /**
     * Standard function for GROUP type modules
     */
    protected static function score_group(int $imet_id, $module_class, string $module_field, string $group_field): ?float
    {
        $records = $module_class::getModule($imet_id);
        $values = $records
            ->groupBy($group_field)
            ->map(function ($group) use ($module_field) {
                $group_values = $group
                    ->filter(fn (ImetModule $value): bool => $value[$module_field] != -99)
                    ->pluck($module_field)
                    ->toArray();

                return filled($group_values)
                    ? static::average($group_values, null)
                    : null;
            })
            ->filter(fn ($value): bool => $value != -99)
            ->toArray();

        $average = static::average($values, null);
        $score = $average !== null ? $average / 3 * 100 : null;

        return $score !== null ?
            round($score, 2)
            : null;
    }
}
