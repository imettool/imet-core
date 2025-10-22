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
use ImetCore\Models\Imet\ScalingUp\Sections\DataTable as ScalingUpDataTable;
use ImetCore\Models\Imet\ScalingUp\Sections\Radar;

trait Data
{
    protected static function retrieve_data(array $items, array $indicators, string $type = 'context'): array
    {
        $api = [];
        $table = ScalingUpDataTable::get_datatable_analysis_indicators($items, $indicators, $type);

        foreach ($table['table'] as $item) {
            $name = $item['name'];
            $id = $item['wdpa_id'];
            unset($item['name']);
            unset($item['wdpa_id']);
            $values = $item;
            $api[] = [
                'wdpa_id' => $id,
                'name' => $name,
                'values' => $values,
            ];
        }

        return [$api];
    }

    public static function threats_table(array $items): array
    {
        $api = [];
        $data = Radar::get_threats_radar_indicators($items);

        foreach ($data['total_categories'][0] as $value) {
            $api[] = [
                'wdpa_id' => $value['id'],
                'name' => $value['name'],
                'values' => $data['radar']['values'][$value['name']],
            ];
        }

        return ['data' => $api, 'labels' => $data['radar']['indicators']];
    }

    public static function management_context_table(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('management_context');
        [$api] = static::retrieve_data($items, $indicators);

        return ['data' => $api, 'labels' => $indicators];
    }

    public static function value_and_importance_sub_indicators_table(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('value_and_importance_sub_indicators');
        [$api] = static::retrieve_data($items, $indicators);

        return ['data' => $api, 'labels' => $indicators];
    }

    public static function planning_indicators_table(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('planning');
        [$api] = static::retrieve_data($items, $indicators, 'planning');

        return ['data' => $api, 'labels' => $indicators];
    }

    public static function inputs_indicators_table(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('inputs');
        [$api] = static::retrieve_data($items, $indicators, 'inputs');

        return ['data' => $api, 'labels' => $indicators];
    }

    public static function outputs_indicators_table(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('outputs');
        [$api] = static::retrieve_data($items, $indicators, 'outputs');

        return ['data' => $api, 'labels' => $indicators];
    }

    public static function outcomes_indicators_table(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('outcomes');
        [$api] = static::retrieve_data($items, $indicators, 'outcomes');

        return ['data' => $api, 'labels' => $indicators];
    }

    public static function process_indicators_table(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('process');
        [$api] = static::retrieve_data($items, $indicators, 'process');

        return ['data' => $api, 'labels' => $indicators];
    }

    public static function process_internal_management_indicators_table(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('process_internal_management_indicators');
        [$api] = static::retrieve_data($items, $indicators, 'process');

        return ['data' => $api, 'labels' => $indicators];
    }

    public static function process_management_protection_indicators_table(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('process_management_protection_indicators');
        [$api] = static::retrieve_data($items, $indicators, 'process');

        return ['data' => $api, 'labels' => $indicators];
    }

    public static function process_stakeholders_relationships_indicators_table(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('process_stakeholders_relationships_indicators');
        [$api] = static::retrieve_data($items, $indicators, 'process');

        return ['data' => $api, 'labels' => $indicators];
    }
}
