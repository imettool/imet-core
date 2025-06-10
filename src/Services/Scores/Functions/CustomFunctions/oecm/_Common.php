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


use ImetCore\Models\Imet\oecm\Modules\Context\ManagementRelativeImportance;

trait _Common{

    public static function score_staff(int $imet_id, $records): ?float
    {
        $values = collect($records)
            ->filter(function ($record){
                return $record['Weight'] !== null
                    && $record['Adequacy'] !== null
                    && $record['Adequacy'] !== -99;
            });

        $scores = $values->groupBy('group_key')
            ->map(function ($group){
                $numerator = $group->sum(function ($item){
                    return $item['Adequacy'] * $item['Weight'];
                });
                $denominator = $group->sum(function ($item){
                    return $item['Weight'];
                });
                return $denominator>0
                    ? $numerator/$denominator * 100 / 3
                    : null;
            })
            ->toArray();

        $score_staff = $scores['group0'] ?? null;
        $score_stakeholders = $scores['group1'] ?? null;

        if($score_staff!==null && $score_stakeholders!==null){
            $relative_importance = ManagementRelativeImportance::getModuleRecords($imet_id);

            $relative_importance = (int) $relative_importance['records'][0]['RelativeImportance'] ?? 0;
            // -2: All decisions are made by staff
            // -1: Majority of decisions are made by staff
            // 0: There is equal contribution of staff and stakeholders to decision-making
            // 1: Majority of decisions are made by stakeholders
            // 2: All decisions are made by stakeholders
            $score = (
                    ($score_staff * (50 - $relative_importance * 25)) +
                    ($score_stakeholders * (50 + $relative_importance * 25))
                ) / 100;
        } elseif($score_staff===null){
            $score = $score_stakeholders;
        } elseif($score_stakeholders===null){
            $score = $score_staff;
        } else {
            $score = null;
        }

        return $score!== null ?
            round($score, 2)
            : null;
    }

}
