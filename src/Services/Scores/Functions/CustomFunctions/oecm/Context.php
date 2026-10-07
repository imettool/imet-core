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

use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\Designation;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\KeyElements;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\SupportsAndConstraints;
use ImetCore\Models\Imet\ImetOecm\Modules\Evaluation\Threats;

trait Context
{
    protected static function score_designations(int $imet_id): ?float
    {
        $records = Designation::getModuleRecords($imet_id)['records'];
        $values = collect($records);

        $numerator = $values->sum(fn (array $item): int|float => $item['EvaluationScore'] * ($item['SignificativeClassification'] ? 3 : 1));
        $denominator = $values->sum(fn (array $item): int => $item['SignificativeClassification'] ? 3 : 1);

        $score = $numerator > 0 && $denominator > 0
            ? $numerator / $denominator * 100 / 3
            : null;

        return $score !== null ?
            round($score, self::DECIMAL_PRECISION)
            : null;
    }

    protected static function score_key_elements(int $imet_id): ?float
    {
        $records = KeyElements::getModule($imet_id);
        $values = $records
            ->filter(fn (KeyElements $record): bool => $record['EvaluationScore'] !== null
                && intval($record['EvaluationScore']) >= 0)
            ->map(function (KeyElements $item): KeyElements {
                $importance = $item['Importance'];
                $integration = $item['EvaluationScore'];
                $toPrioritize = $item['IncludeInStatistics'];
                $item['_numerator'] = $importance * $integration * ($toPrioritize ? 2 : 1);
                $item['_denominator'] = $importance * ($toPrioritize ? 2 : 1);

                return $item;
            });

        $numerator = $values->sum('_numerator');
        $denominator = $values->sum('_denominator');

        $score = $denominator > 0
            ? $numerator / $denominator * 100 / 3
            : null;

        return $score !== null ?
            round($score, self::DECIMAL_PRECISION)
            : null;
    }

    protected static function score_support_contraints(int $imet_id): ?float
    {
        $values = collect(SupportsAndConstraints::calculateRanking($imet_id))
            ->filter(fn (array $item): bool => $item['__score'] !== null);

        $numerator = $values->sum(fn (array $item) => $item['__score']);
        $denominator = $values->sum('Weight');

        $score = $denominator > 0
            ? $numerator / $denominator * 100 / 3
            : null;

        return $score !== null ?
            round($score, self::DECIMAL_PRECISION)
            : null;
    }

    protected static function score_threats(int $imet_id): ?float
    {
        $values = Threats::calculateRanking($imet_id);

        $values = collect($values)
            ->pluck('__score')
            ->toArray();

        $score = static::average($values, null);

        return $score !== null ?
            round($score, self::DECIMAL_PRECISION)
            : null;
    }
}
