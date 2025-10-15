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

use ImetCore\Models\Imet\v2\Modules\Evaluation\BoundaryLevel;
use ImetCore\Models\Imet\v2\Modules\Evaluation\ManagementPlan;
use ImetCore\Models\Imet\v2\Modules\Evaluation\WorkPlan;

trait Planning
{
    protected static function score_p3(int $imet_id): ?float
    {
        $values = BoundaryLevel::getModule($imet_id)
            ->map(function (BoundaryLevel $record): BoundaryLevel {
                $record['score'] =
                    $record['EvaluationScore'] === null || intval($record['EvaluationScore']) === -99
                        ? 0
                        : intval($record['EvaluationScore']);

                return $record;
            });

        $not_null = $values
            ->filter(function (BoundaryLevel $record): bool {
                return $record['EvaluationScore'] !== null;
            })
            ->count();

        $value1 = ($values
            ->map(function (BoundaryLevel $record): int|float {
                return $record['Boundaries'] / 6;
            })
            ->avg() * 100 / 2) ?? 0;

        $value2 = $values
            ->map(function (BoundaryLevel $record): int|float {
                return (($record['score'] / 3 * 100) ?? 0) / 2;
            })
            ->sum();

        $score = $not_null > 0
            ? $value1 + $value2 / $not_null
            : null;

        return $score !== null ?
            round($score, 2)
            : null;
    }

    protected static function score_p4(int $imet_id): ?float
    {
        $records = ManagementPlan::getModule($imet_id)
            ->toArray();

        return static::score_p4_p5($imet_id, $records);
    }

    protected static function score_p5(int $imet_id): ?float
    {
        $records = WorkPlan::getModule($imet_id)
            ->toArray();

        return static::score_p4_p5($imet_id, $records);
    }

    private static function score_p4_p5(int $imet_id, $records): ?float
    {
        $record = $records[0] ?? null;

        if ($record !== null) {
            $record['VisionAdequacy'] = intval($record['VisionAdequacy']);
            $record['PlanAdequacyScore'] = intval($record['PlanAdequacyScore']);

            $numerator =
                ($record['PlanExistence'] ? 1 : 0) +
                ($record['PlanUptoDate'] ? 1 : 0) +
                ($record['PlanApproved'] ? 1 : 0) +
                ($record['PlanImplemented'] ? 1 : 0) +
                ($record['VisionAdequacy'] ?? 0) +
                ($record['PlanAdequacyScore'] ?? 0);

            $score = 100 * $numerator / 10;

            return $score !== null ?
                round($score, 2)
                : null;
        }

        return null;
    }
}
