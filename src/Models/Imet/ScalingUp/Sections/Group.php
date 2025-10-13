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

namespace ImetCore\Models\Imet\ScalingUp\Sections;

use ImetCore\Helpers\ScalingUp\Common;

class Group
{
    public static function get_calculation_grouping_analysis(array $parameters, array $assessments = [], int $scaling_id = 0): array
    {
        $groups = [];
        $average = [];
        $form_ids = [];
        $indicator = [
            'context' => [],
            'outcomes' => [],
            'outputs' => [],
            'process' => [],
            'inputs' => [],
            'planning' => [],
        ];

        foreach ($parameters as $form) {
            $form_ids[] = $form['id'];
            $groups[$form['group']] = [$form['group'], $form['name'], $form['color'] ?? null];
        }
        $indicator = static::calculate_indicators_by_group($indicator, $parameters, $form_ids, $assessments, $scaling_id);

        krsort($groups);

        foreach ($indicator as $indi => $value) {
            foreach ($groups as $key => $group) {
                $average[$group[1]][$indi] = Common::round_number(array_sum($value[$key]) / count($value[$key]));
                if (isset($group[2])) {
                    $average[$group[1]]['color'] = $group[2];
                }
            }
        }

        return $average;
    }

    public static function calculate_indicators_by_group(array $indicator, array $parameters, array $form_ids, array $assessments = [], int $scaling_id = 0): array
    {
        $assessments = count($assessments) ? $assessments : Common::get_assessments($form_ids, $scaling_id);

        foreach (array_keys($indicator) as $indi) {
            foreach ($assessments['data']['assessments'] as $assessment) {
                foreach ($parameters as $form) {

                    if ($form['id'] === $assessment['form_id']) {

                        $indicator[$indi][$form['group']][] = $assessment[$indi];
                    }
                }
            }
        }

        return $indicator;
    }
}
