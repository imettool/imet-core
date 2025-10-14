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

use ImetCore\Models\Imet\v1\Modules\Context\MenacesPressions;
use ImetCore\Models\Imet\v1\Modules\Evaluation\ImportanceClassification;
use ImetCore\Models\Imet\v1\Modules\Evaluation\ImportanceHabitats;
use ImetCore\Models\Imet\v1\Modules\Evaluation\ImportanceSpecies;
use ImetCore\Models\Imet\v1\Modules\Evaluation\SupportsAndConstraints;

trait Context
{
    public static function score_c12(int $imet_id): ?float
    {
        $records = ImportanceClassification::getModule($imet_id);

        $values = $records
            ->filter(function (array $record): bool {
                return $record['EvaluationScore'] !== null
                    && intval($record['EvaluationScore']) >= 0
                    && $record['SignificativeClassification'] !== null;
            });

        $numerator = $values->sum(function (array $item): int|float {
            $item['SignificativeClassification'] = is_string($item['SignificativeClassification'])
                ? (boolval($item['SignificativeClassification']) ? 1 : 0)
                : $item['SignificativeClassification'];

            return (1 + 2 * $item['SignificativeClassification']) * $item['EvaluationScore'];
        });
        $denominator = $values->sum(function (array $item): int|float {
            return 1 + 2 * $item['SignificativeClassification'];
        });

        $score = $denominator > 0
            ? $numerator / $denominator * 100 / 3
            : null;

        return $score !== null ?
            round($score, 2)
            : null;
    }

    public static function score_c13(int $imet_id): ?float
    {
        $records = ImportanceSpecies::getModule($imet_id);

        $values = $records
            ->filter(function (array $record): bool {
                return $record['EvaluationScore'] !== null
                    && intval($record['EvaluationScore']) >= 0;
            })->map(function (array $record): \ModularForms\Models\Module {
                $record['SignificativeSpecies'] = $record['SignificativeSpecies'] === null
                    ? 0
                    : $record['SignificativeSpecies'];

                return $record;
            });

        $numerator = $values->sum(function (array $item): int|float {
            $item['SignificativeSpecies'] = is_string($item['SignificativeSpecies'])
                ? (boolval($item['SignificativeSpecies']) ? 1 : 0)
                : $item['SignificativeSpecies'];

            return (1 + 2 * $item['SignificativeSpecies']) * $item['EvaluationScore'];
        });
        $denominator = $values->sum(function (array $item): int|float {
            $item['SignificativeSpecies'] = is_string($item['SignificativeSpecies'])
                ? (boolval($item['SignificativeSpecies']) ? 1 : 0)
                : $item['SignificativeSpecies'];

            return 1 + 2 * $item['SignificativeSpecies'];
        });

        $score = $denominator > 0
            ? $numerator / $denominator * 100 / 3
            : null;

        return $score !== null ?
            round($score, 2)
            : null;
    }

    public static function score_c14(int $imet_id): ?float
    {
        $records = ImportanceHabitats::getModule($imet_id);

        $values = $records
            ->filter(function (array $record): bool {
                return $record['EvaluationScore'] !== null
                    && intval($record['EvaluationScore']) >= 0;
            })->map(function (array $record): \ModularForms\Models\Module {
                $record['EvaluationScore2'] = $record['EvaluationScore2'] === null
                    ? 1
                    : $record['EvaluationScore2'];

                return $record;
            });

        $numerator = $values->sum(function (array $item): int|float {
            return $item['EvaluationScore2'] * $item['EvaluationScore'];
        });
        $denominator = $values->sum('EvaluationScore2');
        $denominator = $denominator === 0 ? null : $denominator;

        $score = $denominator > 0
            ? $numerator / $denominator * 100 / 3
            : null;

        return $score !== null ?
            round($score, 2)
            : null;
    }

    public static function score_c2(int $imet_id): ?float
    {
        $records = SupportsAndConstraints::getModule($imet_id);

        $values = $records
            ->filter(function (array $record): bool {
                return $record['EvaluationScore'] !== null
                    && intval($record['EvaluationScore']) !== -99
                    && intval($record['EvaluationScore']) > -4;
            });

        $numerator = $values->sum(function (array $item): int|float {
            return $item['EvaluationScore'] * $item['EvaluationScore2'];
        });
        $denominator = $values->sum(function ($item) {
            return $item['EvaluationScore2'] === null
                ? 0
                : $item['EvaluationScore2'];

        });
        $denominator = $denominator === 0 ? null : $denominator;

        $score = $denominator > 0
            ? $numerator / $denominator * 100 / 3
            : null;

        return $score !== null ?
            round($score, 2)
            : null;
    }

    public static function score_c3(int $imet_id): ?float
    {
        $records = MenacesPressions::getModule($imet_id);

        $values = $records
            ->map(function (array $record): \ModularForms\Models\Module {
                $impact = $record['Impact'] !== null ? $record['Impact'] * -1 + 4 : null;
                $extension = $record['Extension'] !== null ? $record['Extension'] * -1 + 4 : null;
                $duration = $record['Duration'] !== null ? $record['Duration'] * -1 + 4 : null;
                $probability = $record['Probability'] !== null ? $record['Probability'] * -1 + 4 : null;
                $trend = $record['Trend'] !== null ? $record['Trend'] * -0.75 + 2.5 : null;
                $product =
                    ($impact === null ? 1 : $impact) *
                    ($extension === null ? 1 : $extension) *
                    ($duration === null ? 1 : $duration) *
                    ($probability === null ? 1 : $probability) *
                    ($trend === null ? 1 : $trend);
                $not_null =
                    ($impact === null ? 0 : 1) +
                    ($extension === null ? 0 : 1) +
                    ($duration === null ? 0 : 1) +
                    ($probability === null ? 0 : 1) +
                    ($trend === null ? 0 : 1);
                $exp_denominator = $not_null === 0 ? null : $not_null;
                $record['n_power'] = $exp_denominator !== null
                    ? 4 - pow($product, (1 / $exp_denominator))
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
            round($score, 2)
            : null;
    }
}
