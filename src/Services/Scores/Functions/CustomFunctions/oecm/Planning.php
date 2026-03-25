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

namespace ImetCore\Services\Scores\Functions\CustomFunctions\oecm;

use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\BoundaryLevel;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\ManagementPlan;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\Objectives;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\WorkPlan;

trait Planning
{
    protected static function score_p3(int $imet_id): ?float
    {
        $records = BoundaryLevel::getModuleRecords($imet_id)['records'];

        if ($records[0]['Boundaries'] === null && $records[0]['Adequacy'] === null) {
            $score = null;
        } elseif ($records[0]['Boundaries'] === null || $records[0]['Adequacy'] === null) {
            $score = ($records[0]['Boundaries'] + $records[0]['Adequacy'] * 2) * 100 / 6;
        } else {
            $score = ($records[0]['Boundaries'] + $records[0]['Adequacy'] * 2) * 100 / 12;
        }

        return $score !== null ?
            round($score, 2)
            : null;
    }

    public static function score_p4(int $imet_id): ?float
    {
        $records = ManagementPlan::getModule($imet_id)
            ->toArray();

        return static::score_p4_p5($imet_id, $records);
    }

    public static function score_p5(int $imet_id): ?float
    {
        $records = WorkPlan::getModule($imet_id)
            ->toArray();

        return static::score_p4_p5($imet_id, $records);
    }

    public static function score_p6(int $imet_id): ?float
    {
        $records = Objectives::getModule($imet_id);

        $denominator = $records
            ->filter(fn (Objectives $item): bool => $item['EvaluationScore'] !== null)
            ->map(fn (Objectives $item): int => $item['group_key'] === 'group0'
                ? 3
                : 1)
            ->sum();

        $score = $records
            ->map(fn (Objectives $item): mixed => $item['group_key'] === 'group0'
                ? $item['EvaluationScore'] * 3
                : $item['EvaluationScore'])
            ->sum();

        $score = $denominator > 0
            ? $score / $denominator * 100 / 3
            : null;

        return $score !== null ?
            round($score, 2)
            : null;
    }

    protected static function score_p4_p5(int $imet_id, $records): ?float
    {
        $record = $records[0] ?? null;

        if ($record !== null) {
            $record['PlanAdequacyScore'] = intval($record['PlanAdequacyScore']);

            $numerator =
                ($record['PlanExistence'] ? 4 : 0) +
                ($record['PrintedCopy'] ? 1 : 0) +
                ($record['KnowledgePercentage'] ?? 0) +
                ($record['PlanUptoDate'] ? 2 : 0) +
                ($record['PlanApproved'] ? 2 : 0) +
                ($record['PlanImplemented'] ? 2 : 0) +
                ($record['PlanAdequacyScore'] ?? 0);

            $score = 100 * $numerator / 17;

            return $score !== null ?
                round($score, 2)
                : null;

        }

        return null;
    }
}
