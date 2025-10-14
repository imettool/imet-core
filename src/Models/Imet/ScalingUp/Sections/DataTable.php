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

class DataTable
{
    /**
     * @return array|array[]
     */
    public static function get_datatable_analysis_indicators(array $form_ids, array $table_indicators, string $type = '', ?int $scaling_id = 0, bool $add_synthetic_indicator = false): array
    {
        $tables = [$type => []];
        $radar_average = ['wdpa_id' => trans('imet-core::analysis_report.average'), 'name' => trans('imet-core::analysis_report.average')] + array_map(function ($val): int {
            return 0;
        }, $table_indicators);
        $filtered = Common::filtered_indicators_and_round_values($form_ids, $type, $table_indicators, $add_synthetic_indicator);

        foreach ($filtered as $id => $values) {
            $pa = Common::get_pa_name($id, $scaling_id);
            $items = array_merge([
                'wdpa_id' => $pa->wdpa_id,
                'name' => $pa->name,
            ], array_map(
                [Common::class, 'round_number'],
                array_diff_key($values, ['indicators_number' => 0]))
            );

            foreach (array_keys($table_indicators) as $v) {
                $value_ind = $values[$v];
                if ((string) $value_ind === '-') {
                    $value_ind = 0;
                }

                $radar_average[$v] = array_key_exists($v, $radar_average) ? $radar_average[$v] + (float) $value_ind : (float) $value_ind;
            }

            $tables[$type][] = $items;
        }

        foreach (array_keys($table_indicators) as $v) {
            $radar_average[$v] = Common::round_number((float) $radar_average[$v] / count($filtered));
        }

        $tables[$type][] = $radar_average;

        return [
            'table' => $tables[$type],
        ];
    }
}
