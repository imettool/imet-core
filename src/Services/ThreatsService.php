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

namespace ImetCore\Services;

class ThreatsService
{
    /**
     * Calculate threat's ranking
     */
    public static function calculateRanking(array $records): array
    {
        return collect($records)
            ->map(function (array $item): array {

                $prod = 1
                    * ($item['Impact'] != null ? 4 - $item['Impact'] : 1)
                    * ($item['Extension'] != null ? 4 - $item['Extension'] : 1)
                    * ($item['Duration'] != null ? 4 - $item['Duration'] : 1)
                    * ($item['Trend'] != null ? (5 / 2 - $item['Trend'] * 3 / 4) : 1)
                    * ($item['Probability'] != null ? 4 - $item['Probability'] : 1);

                $count = ($item['Impact'] != null ? 1 : 0)
                    + ($item['Extension'] != null ? 1 : 0)
                    + ($item['Duration'] != null ? 1 : 0)
                    + ($item['Trend'] != null ? 1 : 0)
                    + ($item['Probability'] != null ? 1 : 0);

                $score = $count > 0
                    ? (4 - $prod ** (1 / $count))
                    : null;

                $score = $score !== null
                    ? (0 - $score) * 100 / 3
                    : null;

                $score = $score !== null
                    ? round($score, 1)
                    : null;

                $item['__score'] = $score;

                return $item;
            })
            ->sortBy('__score')
            ->all();
    }
}
