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

use ImetCore\Models\Imet\v2\Modules\Evaluation\AreaDomination;
use ImetCore\Models\Imet\v2\Modules\Evaluation\AreaDominationMPA;

trait Outputs
{
    protected static function score_op3(int $imet_id): ?float
    {
        $values = AreaDomination::getModule($imet_id)
            ->toArray();
        $values = $values[0] ?? null;

        $score = null;
        if ($values) {

            $numerator = ($values['Patrol'] ?? 0)
                + ($values['RapidIntervention'] ?? 0)
                + ($values['AirVehicles'] ? 1 : 0)
                + ($values['Planes'] ? 1 : 0);

            $denominator = 3
                * (($values['Patrol'] !== null ? 1 : 0) + ($values['RapidIntervention'] !== null ? 1 : 0))
                + (($values['AirVehicles'] !== null ? 1 : 0) + ($values['Planes'] !== null ? 1 : 0));

            $score = $denominator > 0
                ? 100 * $numerator / $denominator
                : null;

        }

        return $score !== null ?
            round($score, 2)
            : null;
    }

    protected static function score_op4(int $imet_id): ?float
    {
        $values = AreaDominationMPA::getModule($imet_id);

        //        dd($values->toArray());

        $formula = function (AreaDominationMPA $item): int|float {
            $denom = (
                ($item['Patrol'] === null ? 0 : 3) +
                ($item['RapidIntervention'] === null ? 0 : 3) +
                ($item['DetectionRemoteSensing'] === null ? 0 : 1) +
                ($item['SpecialMeansRapidIntervention'] === null ? 0 : 1)
            ) * 100;

            if ($denom === 0) {
                return 0;
            }

            return (
                (int) $item['Patrol'] +
                (int) $item['RapidIntervention'] +
                (int) boolval($item['DetectionRemoteSensing']) +
                (int) boolval($item['SpecialMeansRapidIntervention'])
            ) / $denom;
        };

        $sanctuary_score = $values
            ->where('group_key', 'group0')
            ->map(fn ($item): float|int => $formula($item))
            ->first();

        $no_take_score = $values
            ->where('group_key', 'group1')
            ->map(fn ($item): float|int => $formula($item))->avg();

        $buffer_zone_score = $values
            ->whereIn('group_key', ['group2', 'group3'])
            ->map(fn ($item): float|int => $formula($item))->avg();

        $score = self::average([$sanctuary_score, $no_take_score, $buffer_zone_score]);

        return $score !== null ?
            round($score, 2)
            : null;
    }
}
