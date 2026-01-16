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

namespace ImetCore\Models\Imet\ScalingUp\Charts;

use ImetCore\Helpers\ScalingUp\Common;

final class Scatter
{
    /**
     * @param array $parameters
     * @param array $assessments
     * @param bool $not_grouped
     * @param int $scaling_id
     * @return array
     */
    public static function get_scatter_grouping_analysis(array $parameters, array $assessments = [], bool $not_grouped = false, int $scaling_id = 0): array
    {
        $groups = self::extractGroups($parameters);
        $form_ids = array_column($parameters, 'id');

        $indicators = Group::calculate_indicators_by_group(
            self::initializeIndicators(),
            $parameters,
            $form_ids,
            $assessments,
            $scaling_id
        );

        krsort($groups);

        $averages = self::calculateAveragesWithMetadata($indicators, $groups, $not_grouped);
        $scatterData = self::buildScatterPlotData($averages);

        return ['scatter' => $scatterData];
    }

    private static function initializeIndicators(): array
    {
        return [
            'context' => [],
            'outcomes' => [],
            'planning' => [],
            'inputs' => [],
            'process' => [],
            'outputs' => [],
        ];
    }

    private static function extractGroups(array $parameters): array
    {
        $groups = [];
        foreach ($parameters as $form) {
            $groups[$form['group']] = [
                $form['group'],
                $form['name'],
                $form['color'] ?? null,
                $form['id'],
                $form['wdpa_id'] ?? null
            ];
        }
        return $groups;
    }

    private static function calculateAveragesWithMetadata(array $indicators, array $groups, bool $not_grouped): array
    {
        $colors = ['#5470c6', '#91cc75', '#fac858', '#ee6666', '#73c0de', '#3ba272', '#fc8452', '#9a60b4', '#ea7ccc', '#f8f9fa'];
        $averages = [];

        foreach ($indicators as $indicatorType => $values) {
            foreach ($groups as $group) {
                [$groupId, $name, $customColor, $formId, $wdpaId] = $group;

                $average = Common::round_number(array_sum($values[$groupId]) / count($values[$groupId]));
                $averages[$name][$indicatorType] = $average;
                $averages[$name]['color'] = $not_grouped
                    ? $customColor
                    : ($colors[$groupId - 1] ?? $colors[9]);
                $averages[$name]['form_id'] = $formId;
                $averages[$name]['wdpa_id'] = $wdpaId;
                $averages[$name]['legend_selected'] = true;
            }
        }

        return $averages;
    }

    private static function buildScatterPlotData(array $averages): array
    {
        $scatterData = [];

        foreach ($averages as $name => $data) {
            $scatterData[] = [
                'value' => [
                    Common::round_number($data['process']),
                    Common::round_number(($data['context'] + $data['planning'] + $data['inputs']) / 3),
                    Common::round_number(($data['outcomes'] + $data['outputs']) / 2),
                ],
                'name' => $name,
                'id' => $data['form_id'],
                'wdpa_id' => $data['wdpa_id'],
                'itemStyle' => [
                    'borderColor' => $data['color'],
                    'color' => 'transparent',
                    'borderWidth' => '4',
                ],
                'label' => [
                    'position' => 'inside',
                    'color' => $data['color'],
                    'backgroundColor' => 'transparent',
                    'show' => true,
                ],
            ];
        }

        return $scatterData;
    }
}
