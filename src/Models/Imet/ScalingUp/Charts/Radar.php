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
use ImetCore\Models\Imet\v2\Modules;

final class Radar
{
    /**
     * @param array $form_ids
     * @param array $table_indicators
     * @param string $type
     * @param int $scaling_id
     * @return array
     */
    public static function get_radar_analysis_indicators_data(array $form_ids, array $table_indicators, string $type = '', int $scaling_id = 0): array
    {
        $valuesIndicators = [];

        $radar_protected_areas = ['values' => [], 'ids' => []];
        $indicators = [];
        $upperLimit = [];
        $lowerLimit = [];
        $radar_negative_indicators = ['C2', 'OC2', 'OC3'];
        $radar_zero_negative_indicators = ['C3'];
        $radar_indicators_for_negative = [];
        $radar_indicators_zero_negative = [];
        $radar_average = [];
        $indicators_count_to_calculate_average = [];
        $wdpas = [];

        $filtered = Common::filtered_indicators_and_round_values($form_ids, $type, $table_indicators);
        $idx = 0;
        foreach ($filtered as $id => $values) {
            $pa = Common::get_pa_name($id, $scaling_id);
            $protected_area = $pa->name;
            $color = $pa->color ?? null;
            $tables[$type][$idx] = [];
            $tables[$type][$idx]['name'] = $protected_area;
            $wdpas[] = ['id' => $pa->wdpa_id, 'name' => $protected_area];

            unset($values['indicators_number']);
            $i = 0;
            foreach ($values as $v => $value) {
                if ($v !== 'avg') {
                    if ($type === 'process' && stripos((string) $v, '_') === true) {
                        $name = Common::get_all_indicator_labels_cached()[$v].' '.trans('imet-core::analysis_report.legends.'.$v);
                    } else {
                        $name = Common::get_all_indicator_labels_cached()[$v];
                    }

                    $indicators[$i] = $name;

                    if (in_array($v, $radar_negative_indicators) && ! in_array($i, $radar_indicators_for_negative)) {
                        $radar_indicators_for_negative[] = $i;
                    } elseif (in_array($v, $radar_zero_negative_indicators) && ! in_array($i, $radar_indicators_zero_negative)) {
                        $radar_indicators_zero_negative[] = $i;
                    }

                    $rounded_value = Common::round_number($value);
                    $tables[$type][$idx][$v] = $valuesIndicators[$v][] = $rounded_value;

                    if ((string) $value === '-') {
                        $value = 0;
                    } else {
                        $indicators_count_to_calculate_average[$v] = array_key_exists($v, $indicators_count_to_calculate_average) ? $indicators_count_to_calculate_average[$v] + 1 : 1;
                    }

                    $radar_average[$v] = array_key_exists($v, $radar_average) ? $radar_average[$v] + $value : $value;

                    $radar_protected_areas['values'][$protected_area][] = $rounded_value;
                    if ($color) {
                        $radar_protected_areas['values'][$protected_area]['color'] = $color;
                    }

                    $i++;
                }
            }

            $idx++;
        }

        foreach ($valuesIndicators as $k => $v) {
            $upperLimit[$k] = max($v);
            $lowerLimit[$k] = min($v);
        }

        $analysis_diagrams_protected_areas['indicators'] = $indicators;

        foreach ($radar_average as $k => $item) {
            $radar_protected_areas['values']['Average'][] = isset($indicators_count_to_calculate_average[$k]) ? Common::round_number($item / $indicators_count_to_calculate_average[$k]) : '-';
        }

        return [
            'radar_indicators_for_negative' => $radar_indicators_for_negative,
            'radar_indicators_zero_negative' => $radar_indicators_zero_negative,
            'wdpas' => $wdpas,
            'values' => array_merge($radar_protected_areas['values'], [
                'upper limit' => $upperLimit,
                'lower limit' => $lowerLimit,
            ]
            ),
            'indicators' => $analysis_diagrams_protected_areas['indicators'],
        ];
    }

    /**
     * @param array $form_ids
     * @param array $table_indicators
     * @param string $type
     * @param string $colors
     * @param array $options
     * @param string $label
     * @param int|null $scaling_id
     * @return array
     */
    public static function get_radar_analysis_indicators(array $form_ids, array $table_indicators, string $type = '', string $colors = '', array $options = [], string $label = '', ?int $scaling_id = 0): array
    {
        $response = self::get_radar_analysis_indicators_data($form_ids, $table_indicators, $type, $scaling_id);

        $response['values']['upper limit']['lineStyle'] = 'dashed';
        $response['values']['upper limit']['color'] = 'green';

        $response['values']['lower limit']['lineStyle'] = 'dashed';
        $response['values']['lower limit']['color'] = 'yellow';

        $response['values']['Average']['color'] = 'red';
        $response['values']['Average']['legend_selected'] = true;

        return [
            'radar_indicators_for_negative' => $response['radar_indicators_for_negative'],
            'radar_indicators_zero_negative' => $response['radar_indicators_zero_negative'],
            'wdpas' => $response['wdpas'],
            'values' => $response['values'],
            'indicators' => $response['indicators'],
        ];
    }

    /**
     * @param array $form_ids
     * @param bool $width
     * @param array $assessments
     * @param bool $overall
     * @param int|null $scaling_id
     * @return array
     */
    public static function get_radar_indicators(array $form_ids, bool $width = true, array $assessments = [], bool $overall = true, ?int $scaling_id = 0): array
    {
        $assessments = $assessments ?: Common::get_assessments($form_ids, $scaling_id);

        $indicators = self::initializeIndicators();
        $analysis_diagrams = [];
        $form_ids_ordering = [];

        $form_ids = array_reverse($form_ids, true);
        $totalProtectedAreas = count($form_ids);

        foreach (array_keys($indicators) as $indicatorType) {
            foreach ($form_ids as $key => $form_id) {
                $assess = $assessments['data']['assessments'][$key];
                $name = $assess['name'];
                $value = $assess[$indicatorType];

                $indicators[$indicatorType][] = $value;

                if ($overall) {
                    $analysis_diagrams[$name][$indicatorType] = $value;
                } else {
                    $analysis_diagrams[$name][] = $value;
                }

                self::setProtectedAreaMetadata($analysis_diagrams[$name], $assess, $width);
                $form_ids_ordering[$name] = $form_id;
            }
        }

        $average = self::calculateAverages($indicators, $totalProtectedAreas, $overall);
        $limits = self::calculateLimits($indicators);

        krsort($analysis_diagrams);

        return [
            'status' => 'success',
            'data' => [
                'form_ids' => $form_ids_ordering,
                'diagrams' => array_merge($analysis_diagrams, [
                    'Average' => $average,
                    'upper limit' => $limits['upper'],
                    'lower limit' => $limits['lower']
                ]),
            ],
        ];
    }

    /**
     * @return array[]
     */
    private static function initializeIndicators(): array
    {
        return [
            'context' => [],
            'outcomes' => [],
            'outputs' => [],
            'process' => [],
            'inputs' => [],
            'planning' => [],
            'imet_index' => [],
        ];
    }

    /**
     * @param array $diagram
     * @param array $assess
     * @param bool $width
     * @return void
     */
    private static function setProtectedAreaMetadata(array &$diagram, array $assess, bool $width): void
    {
        $diagram['wdpa_id'] = $assess['wdpa_id'];
        $diagram['color'] = $assess['color'];

        if ($width) {
            $diagram['width'] = 4;
        }
    }

    /**
     * @param array $indicators
     * @param int $totalProtectedAreas
     * @param bool $overall
     * @return array
     */
    private static function calculateAverages(array $indicators, int $totalProtectedAreas, bool $overall): array
    {
        $average = ['color' => 'red', 'legend_selected' => true, 'width' => 4];

        if ($totalProtectedAreas === 0) {
            return $average;
        }

        foreach ($indicators as $indicatorType => $values) {
            $calculatedAverage = Common::round_number(array_sum($values) / $totalProtectedAreas);

            if ($overall) {
                $average[$indicatorType] = $calculatedAverage;
            } else {
                $average[] = $calculatedAverage;
            }
        }

        return $average;
    }

    /**
     * @param array $indicators
     * @return array
     */
    private static function calculateLimits(array $indicators): array
    {
        $upperLimit = ['lineStyle' => 'dashed', 'width' => 4, 'color' => 'green'];
        $lowerLimit = ['lineStyle' => 'dashed', 'width' => 4, 'color' => 'black'];

        foreach ($indicators as $indicatorType => $values) {
            if ($values !== []) {
                $upperLimit[$indicatorType] = max($values) ?? 0;
                $lowerLimit[$indicatorType] = min($values) ?? 0;
            }
        }

        return ['upper' => $upperLimit, 'lower' => $lowerLimit];
    }



    /**
     * @param array $form_ids
     * @param int $scaling_id
     * @return array
     */
    public static function get_threats_radar_indicators(array $form_ids, int $scaling_id = 0): array
    {
        $indicators = [];
        $total_categories = [];
        $radar_values = [];

        foreach ($form_ids as $form_id) {
            $pa = Common::get_pa_name($form_id, $scaling_id);
            $stats = Modules\Context\MenacesPressions::getStats($form_id);

            if (empty($indicators)) {
                $indicators = self::extractThreatIndicators($stats['categoryStats']);
            }

            self::aggregateThreatCategories($stats['categoryStats'], $total_categories, $pa);
        }

        $radar_values = self::buildRadarValuesFromCategories($total_categories);

        return [
            'radar' => ['values' => $radar_values, 'indicators' => $indicators],
            'total_categories' => $total_categories
        ];
    }

    /**
     * @param array $categoryStats
     * @return array
     */
    private static function extractThreatIndicators(array $categoryStats): array
    {
        $indicators = [];
        foreach ($categoryStats as $index => $value) {
            $indicators[] = trans('imet-core::v2_context.MenacesPressions.categories.title' . ($index + 1), []);
        }
        return array_reverse($indicators);
    }

    /**
     * @param array $categoryStats
     * @param array $total_categories
     * @param object $pa
     * @return void
     */
    private static function aggregateThreatCategories(array $categoryStats, array &$total_categories, object $pa): void
    {
        foreach ($categoryStats as $key => $value) {
            $processedValue = ($value === '') ? '-' : Common::round_number(-1 * (float) $value);

            $record = [
                'id' => $pa->wdpa_id,
                'name' => $pa->name,
                'value' => $processedValue
            ];

            if ($pa->color) {
                $record['color'] = $pa->color;
            }

            $total_categories[$key][] = $record;
        }
    }

    /**
     * @param array $total_categories
     * @return array
     */
    private static function buildRadarValuesFromCategories(array &$total_categories): array
    {
        $radar_values = [];

        foreach ($total_categories as $key => $category) {
            usort($category, fn(array $a, array $b): int => $a['value'] <=> $b['value']);
            $total_categories[$key] = $category;

            foreach ($category as $item) {
                $name = $item['name'];

                if (!isset($radar_values[$name])) {
                    $radar_values[$name] = [];
                    if ($item['color'] !== null) {
                        $radar_values[$name]['color'] = $item['color'];
                    }
                }

                array_unshift($radar_values[$name], $item['value']);
            }
        }

        return $radar_values;
    }

}
