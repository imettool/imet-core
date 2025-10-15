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

use ImetCore\Models\Imet\v2\Modules\Evaluation\EcosystemServices;
use ImetCore\Models\Imet\v2\Modules\Evaluation\EquipmentMaintenance;
use ImetCore\Models\Imet\v2\Modules\Evaluation\GovernanceLeadership;
use ImetCore\Models\Imet\v2\Modules\Evaluation\LawEnforcementImplementation;
use ImetCore\Models\Imet\v2\Modules\Evaluation\StaffCompetence;
use ImetCore\Models\Imet\v2\Modules\Evaluation\StakeholderCooperation;

trait Process
{
    protected static function score_pr1(int $imet_id): ?float
    {
        $staff_weights = static::staff_weights($imet_id);

        $values = StaffCompetence::getModule($imet_id)
            ->map(function (StaffCompetence $record) use ($staff_weights): StaffCompetence {
                if ($record['EvaluationScore'] !== null) {
                    $eval_score = $record['EvaluationScore'];
                } elseif (isset($staff_weights[$record['Theme']])) {
                    $eval_score = $staff_weights[$record['Theme']]['ratio03'];
                } else {
                    $eval_score = 0;
                }

                $weight = 1;
                $record['eval_score'] = $eval_score;
                if ($record['EvaluationScore'] === null && isset($staff_weights[$record['Theme']])) {
                    $weight = $staff_weights[$record['Theme']]['w_avg'];
                }

                $record['eval_score'] = $eval_score;
                $record['weight'] = $weight;

                return $record;
            });

        $weights = $values->sum('weight');
        $weighted_eval_core = $values->sum(fn (StaffCompetence $item): int|float => intval($item['eval_score']) * $item['weight']);
        $weighted_percentage = (function ($data): null|int|float {
            $sum = 0;
            foreach ($data as $item) {
                if ($item['PercentageLevel'] === null && $item['weight'] === null) {
                    $sum += 0;
                } elseif ($item['PercentageLevel'] === null || $item['weight'] === null) {
                    return null;
                } else {
                    $sum += ($item['PercentageLevel'] * $item['weight']);
                }
            }

            return $sum;
        })($values);

        $score = $weights > 0 && $weighted_eval_core !== null && $weighted_percentage !== null
            ? 100 / 6 * (($weighted_eval_core + $weighted_percentage) / $weights)
            : null;

        return $score !== null ?
            round($score, 2)
            : null;
    }

    protected static function score_pr4(int $imet_id): ?float
    {
        $records = GovernanceLeadership::getModule($imet_id);

        $sum = null;
        if ($records->isNotEmpty()) {
            $sum = $records->sum(fn (GovernanceLeadership $item): int => intval($item['EvaluationScoreGovernace']) + intval($item['EvaluationScoreLeadership']));
        }

        $score = $sum !== null
            ? $sum / 6 * 100
            : null;

        return $score !== null ?
            round($score, 2)
            : null;
    }

    protected static function score_pr6(int $imet_id): ?float
    {
        $values = EquipmentMaintenance::getModule($imet_id)
            ->map(function (EquipmentMaintenance $record): EquipmentMaintenance {
                $record['numerator'] = $record['EvaluationScore'] === -99 || $record['EvaluationScore'] === null
                    ? null
                    : intval($record['EvaluationScore']) * $record['AdequacyLevel'];
                $record['denominator'] = $record['EvaluationScore'] === -99 || $record['EvaluationScore'] === null
                    ? null
                    : $record['AdequacyLevel'];
                $record['denominator'] ??= 0;

                return $record;
            });

        $numerator = $values->sum('numerator');
        $denominator = $values->sum('denominator');

        $score = $denominator > 0
            ? $numerator / $denominator / 3 * 100
            : null;

        return $score !== null ?
            round($score, 2)
            : null;
    }

    protected static function score_pr8(int $imet_id): ?float
    {
        $records = LawEnforcementImplementation::getModule($imet_id);

        $terrestrial_avg = $records
            ->where('group_key', 'group0')
            ->pluck('Adequacy')
            ->filter(fn ($value): bool => $value != -99)
            ->avg();

        $marine_avg = $records
            ->where('group_key', 'group1')
            ->pluck('Adequacy')
            ->filter(fn ($value): bool => $value != -99)
            ->avg();

        $average = static::average([$terrestrial_avg, $marine_avg], null);
        $score = $average !== null ? $average / 3 * 100 : null;

        return $score !== null ?
            round($score, 2)
            : null;
    }

    protected static function score_pr10(int $imet_id): ?float
    {
        $values = StakeholderCooperation::getModule($imet_id)
            ->sortBy('Element')
            ->map(function (StakeholderCooperation $record): StakeholderCooperation {
                $record['score'] = $record['Cooperation'] === -99 ? 0 : $record['Cooperation'];
                $record['weight'] =
                    ($record['MPInvolvement'] ?? 0) +
                    ($record['BAInvolvement'] ?? 0) +
                    ($record['EEInvolvement'] ?? 0) +
                    ($record['MPIImplementation'] ?? 0);

                return $record;
            })
            ->groupBy('group_key')
            ->map(function ($group): array {
                $sw = $group->sum('weight');
                $wi = (function ($data): int|float|null {
                    $sum = null;
                    foreach ($data as $item) {
                        if ($item['score'] === null) {
                            continue;
                        }

                        if ($item['weight'] === null) {
                            continue;
                        }

                        $sum += ($item['score'] / 3 * $item['weight']);
                    }

                    return $sum;
                })($group);

                return [
                    'sw' => $sw,
                    'wi' => $wi,
                ];
            });

        $numerator = $values->sum('wi');
        $denominator = $values->sum('sw');

        $score = $denominator > 0
            ? $numerator / $denominator * 100
            : null;

        return $score !== null ?
            round($score, 2)
            : null;
    }

    protected static function score_pr18(int $imet_id): ?float
    {
        $records = EcosystemServices::getModule($imet_id);
        $scores = $records->map(fn ($record): mixed => $record['EvaluationScore'] === -99 ? null : $record['EvaluationScore']);

        $score = $scores->isNotEmpty()
            ? static::average($scores, null) * 100 / 3
            : null;

        return $score !== null ?
            round($score, 2)
            : null;
    }
}
