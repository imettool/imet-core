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

namespace ImetCore\Models\Imet\API\ScalingUp;

use ImetCore\Models\Imet\ScalingUp\Sections\Group as SectionGroup;
use ImetCore\Models\Imet\ScalingUp\Sections\Scatter;

trait Group
{
    public static function get_grouping_analysis(array $parameters): array
    {
        $labels = [];
        $api = SectionGroup::get_calculation_grouping_analysis($parameters, []);
        foreach ($api as $indicators) {
            foreach ($indicators as $indi => $value) {
                $labels[$indi] = trans('imet-core::common.steps_eval.'.$indi);
            }
        }

        return ['data' => $api, 'labels' => $labels];
    }

    public static function get_grouping_analysis_by_indicators(array $parameters): array
    {
        $labels = [
            'process' => trans('imet-core::common.steps_eval.process'),
            'context_planning_inputs' => trans('imet-core::common.steps_eval.context').', '.trans('imet-core::common.steps_eval.planning').', '.trans('imet-core::common.steps_eval.inputs'),
            'outcomes_outputs' => trans('imet-core::common.steps_eval.outcomes').', '.trans('imet-core::common.steps_eval.outputs'),
        ];

        $api = [];

        $data = Scatter::get_scatter_grouping_analysis($parameters, []);
        foreach ($data['data']['scatter'] as $item) {
            $api[] = ['name' => $item['name'], 'value' => ['process' => $item['value'][0],
                'context_planning_inputs' => $item['value'][1],
                'outcomes_outputs' => $item['value'][2]]];
        }

        return ['data' => $api, 'labels' => $labels];
    }
}
