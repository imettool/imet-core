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

use ImetCore\Models\Imet\Components\Modules\ImetModule;
use ImetCore\Models\Imet\ImetV2\Modules\Context\Equipments;
use ImetCore\Models\Imet\ImetV2\Modules\Context\ManagementStaff;
use ImetCore\Models\Imet\ImetV2\Modules\Evaluation\BudgetAdequacy;
use ImetCore\Models\Imet\ImetV2\Modules\Evaluation\BudgetSecurization;
use ImetCore\Models\Imet\ImetV2\Modules\Evaluation\ManagementEquipmentAdequacy;
use ImetCore\Models\Imet\ImetV2\Modules\Evaluation\Staff;

trait Inputs
{
    public static function staff_weights(int $imet_id, $staff = null): array
    {
        $records = $staff ?? ManagementStaff::getModule($imet_id);

        return $records
            ->map(function (ImetModule $record): ImetModule {
                $expected = intval($record['ExpectedPermanent']) === 0 ? null : $record['ExpectedPermanent'];
                $record['ratio'] = $expected !== null
                    ? min(1, (($record['ActualPermanent'] ?? 0) + ($record['ActualPermanentPartnersOrCommunities'] ?? 0)) / ($expected))
                    : 1;
                $record['ratio03'] = $record['ratio'] === 0
                    ? 0
                    : ($record['ratio'] > 0
                        ? ceil($record['ratio'] * 4 - 1)
                        : null);
                $record['w_avg'] = $expected !== null
                    ? 1 + log($expected)
                    : null;

                return $record;
            })
            ->keyBy('Function')
            ->map(fn ($record) => collect($record)->only(['Function', 'ActualPermanent', 'ActualPermanentPartnersOrCommunities', 'ExpectedPermanent', 'ratio', 'ratio03', 'w_avg']))
            ->toArray();
    }

    protected static function score_i2(int $imet_id): ?float
    {
        $values = Staff::getModule($imet_id)
            ->map(fn (Staff $item): int|float => $item['StaffCapacityAdequacy'] * $item['StaffNumberAdequacy'] / 12 * 100)
            ->all();

        return static::average($values, 2);
    }

    protected static function score_i3(int $imet_id): ?float
    {
        $records = BudgetAdequacy::getModule($imet_id)
            ->toArray();

        $value = filled($records)
            ? (int) $records[0]['EvaluationScore']
            : null;

        if ($value === 0) {
            $score = 0;
        } elseif ($value === 1) {
            $score = 12.5;
        } elseif ($value === 2) {
            $score = 37.5;
        } elseif ($value === 3) {
            $score = 60;
        } elseif ($value === 4) {
            $score = 80;
        } elseif ($value === 5) {
            $score = 100;
        } else {
            $score = null;
        }

        return $score !== null
            ? floatval($score)
            : null;
    }

    protected static function score_i4(int $imet_id): ?float
    {
        $records = BudgetSecurization::getModule($imet_id)
            ->toArray();
        $record = $records[0] ?? null;

        $score = $record !== null && $record['Percentage'] !== null && $record['EvaluationScore'] !== null
            ? (
                $record['Percentage'] / 5 +
                $record['EvaluationScore'] / 3
            ) / 2 * 100
        : null;

        return $score !== null ?
            round($score, 2)
            : null;
    }

    protected static function score_i5(int $imet_id): ?float
    {
        $equipment = Equipments::getModule($imet_id)
            ->groupBy('group_key')
            ->map(function ($group) {
                $group_values = $group
                    ->pluck('AdequacyLevel')
                    ->toArray();

                return filled($group_values)
                    ? static::average($group_values, null)
                    : null;
            });

        $equipment_adequacy = ManagementEquipmentAdequacy::getModule($imet_id)
            ->map(function (ManagementEquipmentAdequacy $record): ManagementEquipmentAdequacy {
                $record['Importance'] = $record['Importance'] !== null
                    ? floatval($record['Importance'])
                    : 0;

                return $record;
            })
            ->pluck('Importance', 'Equipment');

        $values = $equipment->map(function ($item, $index) use ($equipment_adequacy): array {
            $importance = $equipment_adequacy[$index] ?? null;
            $imp_p1 = $importance + 1;
            $eq_imp = $imp_p1 * $item;

            return [
                'group_key' => $index,
                'AdequacyLevel' => $item,
                'imp_p1' => $imp_p1,
                'eq_imp' => $eq_imp,
            ];
        });

        $numerator = $values->sum('eq_imp');
        $denominator = $values->sum('imp_p1');

        $score = $denominator > 0
            ? $numerator / $denominator * 100 / 3
            : null;

        return $score !== null ?
            round($score, 2)
            : null;
    }
}
