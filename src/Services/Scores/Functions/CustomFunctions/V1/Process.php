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

namespace ImetCore\Services\Scores\Functions\CustomFunctions\V1;

use ImetCore\Models\Imet\Components\Modules\ImetModule;
use ImetCore\Models\Imet\v1\Modules\Evaluation\ActorsRelations;
use ImetCore\Models\Imet\v1\Modules\Evaluation\Control;
use ImetCore\Models\Imet\v1\Modules\Evaluation\StaffCompetence;

trait Process
{
    public static function score_pr1(int $imet_id, $records = null, $staff_weights = null): ?float
    {
        $staff_weights ??= static::staff_weights($imet_id);
        $records ??= StaffCompetence::getModule($imet_id);

        $values = $records
            ->filter(fn (ImetModule $record): bool => $record['EvaluationScore'] !== null)
            ->map(function (ImetModule $record) use ($staff_weights): ImetModule {
                $record['eval_score'] = $record['EvaluationScore'] ?: $staff_weights[$record['Theme']]['ratio03'];
                $record['weight'] = $record['EvaluationScore'] === null ? $staff_weights[$record['Theme']]['w_avg'] : 1;

                return $record;
            });

        $sum_weight = $values->sum('weight');
        $sum_weight_score = $values->sum(fn (ImetModule $item): int|float => $item['eval_score'] * $item['weight']);

        $score = $sum_weight > 0
            ? $sum_weight_score / $sum_weight * 100 / 3
            : null;

        return $score !== null ?
            round($score, 2)
            : null;
    }

    public static function score_pr9(int $imet_id): ?float
    {
        $records = Control::getModule($imet_id)
            ->toArray();

        $value = filled($records)
            ? (int) $records[0]['EvaluationScore']
            : null;

        if ($value === 0) {
            $score = 12.5;
        } elseif ($value === 1) {
            $score = 37.5;
        } elseif ($value === 2) {
            $score = 62.5;
        } elseif ($value === 3) {
            $score = 87.5;
        } elseif ($value === 4) {
            $score = 100;
        } else {
            $score = null;
        }

        return $score;
    }

    protected static function score_pr13(int $imet_id): ?float
    {
        $values = ActorsRelations::getModule($imet_id)
            ->filter(fn (ActorsRelations $record): bool => $record['EvaluationScore'] !== null)
            ->map(function (ActorsRelations $record): ActorsRelations {
                $record['eval'] =
                    $record['EvaluationScore'] === -99
                        ? null
                        : $record['EvaluationScore'];

                return $record;
            });

        $count = $values->count();
        $sum = null;
        $values
            ->map(function (ActorsRelations $record) use (&$sum): void {
                if ($record['eval'] !== null) {
                    $sum += $record['eval'];
                }
            });

        if ($sum === null) {
            $score = null;
        } elseif ($sum > 0) {
            $score = $count < 5 ? $sum / 5 : $sum / $count;
        } else {
            $score = 0;
        }

        $score = $score !== null
            ? $score * 100 / 3
            : null;

        return $score !== null ?
            round($score, 2)
            : null;
    }
}
