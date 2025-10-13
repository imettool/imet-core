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

namespace ImetCore\Models\Imet\API\ScalingUp\Analysis;

use ImetCore\Helpers\ScalingUp\Common;
use ImetCore\Models\Imet\ScalingUp\Sections\Radar as ScalingUpRadar;

trait DataUpperLowerAverage
{
    private static function retrieve_data_upper_low_average(array $items, array $indicators, string $type = 'context'): array
    {
        $keys = array_keys($indicators);
        $api = [];
        $radar = ScalingUpRadar::get_radar_analysis_indicators_data($items, $indicators, $type);

        foreach ($radar['wdpas'] as $wdpa) {
            $name = $wdpa['name'];
            $values = $radar['values'][$name];
            $indicator_values = [];
            foreach ($values as $k => $v) {
                $indicator_values[$keys[$k]] = $v;
            }

            $indicator = $wdpa['name'];
            $api[] = [
                'wdpa_id' => $wdpa['id'],
                'name' => $indicator,
                'values' => $indicator_values,
            ];
        }

        $average_values = [];

        foreach ($radar['values']['Average'] as $k => $v) {
            $average_values[$keys[$k]] = $v;
        }

        $api[] = [
            'wdpa_id' => 0,
            'name' => 'Lower Limit',
            'values' => $radar['values']['lower limit'],
        ];
        $api[] = [
            'wdpa_id' => 0,
            'name' => 'Upper Limit',
            'values' => $radar['values']['upper limit'],
        ];

        $api[] = [
            'wdpa_id' => 0,
            'name' => 'Average',
            'values' => $average_values,
        ];
        // }

        return [$api];
    }

    public static function management_context_radar(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('management_context');
        [$api] = static::retrieve_data_upper_low_average($items, $indicators);

        return ['data' => $api, 'labels' => $indicators];
    }

    public static function value_and_importance_sub_indicators_radar(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('value_and_importance_sub_indicators');
        [$api] = static::retrieve_data_upper_low_average($items, $indicators);

        return ['data' => $api, 'labels' => $indicators];
    }

    public static function planning_indicators_radar(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('planning');
        [$api] = static::retrieve_data_upper_low_average($items, $indicators, 'planning');

        return ['data' => $api, 'labels' => $indicators];
    }

    public static function inputs_indicators_radar(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('inputs');
        [$api] = static::retrieve_data_upper_low_average($items, $indicators, 'inputs');

        return ['data' => $api, 'labels' => $indicators];
    }

    public static function outputs_indicators_radar(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('outputs');
        [$api] = static::retrieve_data_upper_low_average($items, $indicators, 'outputs');

        return ['data' => $api, 'labels' => $indicators];
    }

    public static function outcomes_indicators_radar(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('outcomes');
        [$api] = static::retrieve_data_upper_low_average($items, $indicators, 'outcomes');

        return ['data' => $api, 'labels' => $indicators];
    }

    public static function process_indicators_radar(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('process');
        [$api] = static::retrieve_data_upper_low_average($items, $indicators, 'process');

        return ['data' => $api, 'labels' => $indicators];
    }

    public static function process_internal_management_indicators_radar(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('process_internal_management_indicators');
        [$api] = static::retrieve_data_upper_low_average($items, $indicators, 'process');

        return ['data' => $api, 'labels' => $indicators];
    }

    public static function process_management_protection_indicators_radar(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('process_management_protection_indicators');
        [$api] = static::retrieve_data_upper_low_average($items, $indicators, 'process');

        return ['data' => $api, 'labels' => $indicators];
    }

    public static function process_stakeholders_relationships_indicators_radar(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('process_stakeholders_relationships_indicators');
        [$api] = static::retrieve_data_upper_low_average($items, $indicators, 'process');

        return ['data' => $api, 'labels' => $indicators];
    }
}
