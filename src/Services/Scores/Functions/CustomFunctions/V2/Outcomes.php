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

namespace ImetCore\Services\Scores\Functions\CustomFunctions\V2;

use ImetCore\Models\Imet\v2\Modules\Evaluation\KeyConservationTrend;

trait Outcomes
{
    protected static function score_oc2(int $imet_id): ?float
    {
        $values = KeyConservationTrend::getModule($imet_id)
            ->filter(fn (KeyConservationTrend $record): bool => intval($record['Condition']) !== -99
                && $record['Condition'] !== null
                && intval($record['Trend']) !== -99
                && $record['Trend'] !== null)
            ->groupBy('group_key')
            ->map(function ($group): int|float {
                $sum_cond = static::average($group->pluck('Condition')->toArray(), null) * 100 / 3;
                $sum_trend = static::average($group->pluck('Trend')->toArray(), null) * 100 / 3;

                return ($sum_cond + $sum_trend) / 2;
            })
            ->all();
        $score = static::average($values, null);

        return $score !== null ?
            round($score, 2)
            : null;

    }
}
