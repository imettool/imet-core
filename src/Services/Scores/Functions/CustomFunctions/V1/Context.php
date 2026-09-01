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

use ImetCore\Models\Imet\ImetV1\Modules\Context\MenacesPressions;
use ImetCore\Models\Imet\ImetV1\Modules\Evaluation\ImportanceClassification;
use ImetCore\Models\Imet\ImetV1\Modules\Evaluation\ImportanceHabitats;
use ImetCore\Models\Imet\ImetV1\Modules\Evaluation\ImportanceSpecies;
use ImetCore\Models\Imet\ImetV1\Modules\Evaluation\SupportsAndConstraints;

trait Context
{
    public static function score_c12(int $imet_id): ?float
    {
        $records = ImportanceClassification::getModule($imet_id);

        $values = $records
            ->filter(fn (ImportanceClassification $record): bool => $record['EvaluationScore'] !== null
                && intval($record['EvaluationScore']) >= 0
                && $record['SignificativeClassification'] !== null);

        $numerator = $values->sum(function (ImportanceClassification $item): int|float {
            $item['SignificativeClassification'] = is_string($item['SignificativeClassification'])
                ? (boolval($item['SignificativeClassification']) ? 1 : 0)
                : $item['SignificativeClassification'];

            return (1 + 2 * $item['SignificativeClassification']) * $item['EvaluationScore'];
        });
        $denominator = $values->sum(fn (ImportanceClassification $item): int|float => 1 + 2 * $item['SignificativeClassification']);

        $score = $denominator > 0
            ? $numerator / $denominator * 100 / 3
            : null;

        return $score !== null ?
            round($score, self::DECIMAL_PRECISION)
            : null;
    }

    public static function score_c13(int $imet_id): ?float
    {
        $values = ImportanceSpecies::getModule($imet_id)
            ->filter(fn (ImportanceSpecies $record): bool => $record['EvaluationScore'] !== null
                && intval($record['EvaluationScore']) >= 0)->map(function (ImportanceSpecies $record): ImportanceSpecies {
                    $record['SignificativeSpecies'] ??= 0;

                    return $record;
                });

        $numerator = $values->sum(function (ImportanceSpecies $item): int|float {
            $item['SignificativeSpecies'] = is_string($item['SignificativeSpecies'])
                ? (boolval($item['SignificativeSpecies']) ? 1 : 0)
                : $item['SignificativeSpecies'];

            return (1 + 2 * $item['SignificativeSpecies']) * $item['EvaluationScore'];
        });
        $denominator = $values->sum(function (ImportanceSpecies $item): int|float {
            $item['SignificativeSpecies'] = is_string($item['SignificativeSpecies'])
                ? (boolval($item['SignificativeSpecies']) ? 1 : 0)
                : $item['SignificativeSpecies'];

            return 1 + 2 * $item['SignificativeSpecies'];
        });

        $score = $denominator > 0
            ? $numerator / $denominator * 100 / 3
            : null;

        return $score !== null ?
            round($score, self::DECIMAL_PRECISION)
            : null;
    }

    public static function score_c14(int $imet_id): ?float
    {
        $values = ImportanceHabitats::getModule($imet_id)
            ->filter(fn (ImportanceHabitats $record): bool => $record['EvaluationScore'] !== null
                && intval($record['EvaluationScore']) >= 0)->map(function (ImportanceHabitats $record): ImportanceHabitats {
                    $record['EvaluationScore2'] ??= 1;

                    return $record;
                });

        $numerator = $values->sum(fn (ImportanceHabitats $item): int|float => $item['EvaluationScore2'] * $item['EvaluationScore']);
        $denominator = $values->sum('EvaluationScore2');
        $denominator = $denominator === 0 ? null : $denominator;

        $score = $denominator > 0
            ? $numerator / $denominator * 100 / 3
            : null;

        return $score !== null ?
            round($score, self::DECIMAL_PRECISION)
            : null;
    }

    public static function score_c2(int $imet_id): ?float
    {
        $values = SupportsAndConstraints::getModule($imet_id)
            ->filter(fn (SupportsAndConstraints $record): bool => $record['EvaluationScore'] !== null
                && intval($record['EvaluationScore']) !== -99
                && intval($record['EvaluationScore']) > -4);

        $numerator = $values->sum(fn (SupportsAndConstraints $item): int|float => $item['EvaluationScore'] * $item['EvaluationScore2']);
        $denominator = $values->sum(fn ($item): mixed => $item['EvaluationScore2'] ?? 0);
        $denominator = $denominator === 0 ? null : $denominator;

        $score = $denominator > 0
            ? $numerator / $denominator * 100 / 3
            : null;

        return $score !== null ?
            round($score, self::DECIMAL_PRECISION)
            : null;
    }

    public static function score_c3(int $imet_id): ?float
    {
        $records = MenacesPressions::getModule($imet_id);

        $values = $records
            ->map(function (MenacesPressions $record): MenacesPressions {
                $impact = $record['Impact'] !== null ? $record['Impact'] * -1 + 4 : null;
                $extension = $record['Extension'] !== null ? $record['Extension'] * -1 + 4 : null;
                $duration = $record['Duration'] !== null ? $record['Duration'] * -1 + 4 : null;
                $probability = $record['Probability'] !== null ? $record['Probability'] * -1 + 4 : null;
                $trend = $record['Trend'] !== null ? $record['Trend'] * -0.75 + 2.5 : null;
                $product =
                    ($impact ?? 1) *
                    ($extension ?? 1) *
                    ($duration ?? 1) *
                    ($probability ?? 1) *
                    ($trend ?? 1);
                $not_null =
                    ($impact === null ? 0 : 1) +
                    ($extension === null ? 0 : 1) +
                    ($duration === null ? 0 : 1) +
                    ($probability === null ? 0 : 1) +
                    ($trend === null ? 0 : 1);
                $exp_denominator = $not_null === 0 ? null : $not_null;
                $record['n_power'] = $exp_denominator !== null
                    ? 4 - $product ** (1 / $exp_denominator)
                    : null;

                return $record;
            })
            ->groupBy('group_key')
            ->map(function ($group): int|float|null {
                $group_values = $group
                    ->pluck('n_power')
                    ->toArray();
                $average = static::average($group_values, null);

                return $average !== null
                    ? -1 * $average
                    : null;
            })
            ->all();

        $score = static::average($values, null);

        $score = $score !== null
            ? $score * 100 / 3
            : null;

        return $score !== null ?
            round($score, self::DECIMAL_PRECISION)
            : null;
    }
}
