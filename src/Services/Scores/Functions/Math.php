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

trait Math
{
    protected static function average($data, $precision = 2): ?float
    {
        $sum = 0;
        $count_not_null = 0;
        foreach ($data as $item) {
            $sum += $item ?? 0;
            if ($item !== null) {
                $count_not_null++;
            }
        }
        $average = $count_not_null > 0
            ? $sum / $count_not_null
            : null;

        return $average !== null && $precision !== null
            ? round($average, $precision)
            : $average;
    }
}
