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
use ImetCore\Models\Imet\v2\Modules;

final class AverageContribution
{
    public static function average_contribution_calculations_threat(array $form_ids, string $colors = '', array $options = [], string $label = '', string $type = ''): array
    {
        $indicators = [];
        $indicators_average_contribution = [];
        $protected_areas = [];
        $data = [];
        foreach ($form_ids as $j => $form_id) {
            $protected_areas[$j] = Modules\Context\MenacesPressions::getStats($form_id);

            if ($indicators === []) {

                foreach ($protected_areas[$j]['categoryStats'] as $c => $value) {
                    $name = trans('imet-core::v2_context.MenacesPressions.categories.title'.($c + 1), []);
                    array_unshift($indicators, $name);
                    $indicators_average_contribution[] = $name;
                }
            }

            foreach ($protected_areas[$j]['categoryStats'] as $k => $protected_area) {
                $value = $protected_area === ''
                    ? '-'
                    : Common::round_number((-1 * (float) $protected_area));
                $data[$k][] = $valuesIndicators[$k][] = $value;
            }
        }

        $average_contribution = [];
        if (array_filter(array_keys($data), 'is_string') === []) {
            krsort($data);
        }

        $average_contribution = self::calculate_data_average_contribution($average_contribution, $data, $colors, $label, $type);

        $average_contribution['options'] = $options !== [] ? $options : null;
        $average_contribution['indicators'] = $indicators_average_contribution;

        if (array_key_exists('data', $average_contribution)) {
            usort($average_contribution['data']['Average'], fn (array $a, array $b): int => -($a['value'] <=> $b['value']));
        }

        $average_contribution['legends'] = [trans('imet-core::v2_common.steps.threats'), trans('imet-core::analysis_report.variability')];

        return ['average_contribution' => $average_contribution];
    }

    public static function average_contribution_calculations(array $form_ids, array $table_indicators, string $type = '', string $colors = '', array $options = [], string $label = '', string $origType = ''): array
    {
        $data = [$type => []];
        $radar_negative_indicators = ['C2', 'OC2', 'OC3'];
        $radar_zero_negative_indicators = ['C3'];
        $legends_match = [
            'process_PRA' => 'PRA',
            'process_PRB' => 'PRB',
            'process_PRC' => 'PRC',
            'process_PRD' => 'PRD',
            'process_PRE' => 'PRE',
            'process_PRF' => 'PRF',
        ];

        $filtered = Common::filtered_indicators_and_round_values($form_ids, $type, $table_indicators);

        foreach ($filtered as $values) {
            unset($values['indicators_number']);
            foreach ($values as $v => $value) {
                if ($v !== 'avg') {
                    if (in_array($v, $radar_negative_indicators)) {
                        $correction_value = Common::values_correction($v, (float) $value);
                    } elseif (in_array($v, $radar_zero_negative_indicators)) {
                        $correction_value = Common::values_correction($v, (float) $value);
                    } else {
                        $correction_value = $value;
                    }

                    $data[$type][$v][] = $correction_value;
                }
            }
        }

        if (array_filter(array_keys($data), 'is_string') === []) {
            krsort($data[$type]);
        }

        $average_contribution = [];
        $average_contribution = self::calculate_data_average_contribution($average_contribution, $data[$type], $colors, $label, $type);
        $average_contribution['options'] = $options !== [] ? $options : null;
        if (str_contains($origType, '_')) {
            $name = explode('_', $origType);
            $legend_name = trans('imet-core::analysis_report.assessment.'.$legends_match[$origType]);
        } else {
            $legend_name = trans('imet-core::common.steps_eval.'.$origType);
        }

        $average_contribution['legends'] = [$legend_name, trans('imet-core::analysis_report.variability')];

        return ['average_contribution' => $average_contribution];
    }

    private static function calculate_data_average_contribution(array $average_contribution, array $data, string $colors, string $label, string $type): array
    {
        $i = 0;

        foreach ($data as $index => $value) {
            if ($value !== '-') {

                $v = $index;

                if (is_numeric($index)) {
                    $v = (int) $index + 1;
                }

                $values = array_filter(array_values($value), fn ($v): bool => is_numeric($v));
                $percentile_10 = Common::round_number(Common::get_percentile($values, 10));
                $percentile_90 = Common::round_number(Common::get_percentile($values, 90));
                $average_value = $values !== [] ? Common::round_number(array_sum($values) / count($values)) : 0; // check
                $average[] = $average_value;
                $average_contribution = self::getAverage_contribution($average_value, $percentile_10, $percentile_90, $v, $colors, $average_contribution, $i, $index, $label, $type);
            }

            $i++;
        }

        return $average_contribution;
    }

    private static function getAverage_contribution(float|string|int $average_value, float|string $percentile_10, float|string $percentile_90, int|string $v, string $colors, array $average_contribution, int $i, int|string $index, string $label, string $type): array
    {
        $average_contribution['data']['Average'][$i] = [
            'value' => $average_value,
            'upper limit' => [$percentile_10, $percentile_90],
            'label' => trans('imet-core::v2_common.assessment.'.$v),
            'color' => '#000000',
            'itemStyle' => ['color' => $colors],
        ];

        if (is_numeric($index)) {
            $average_contribution['data']['Average'][$i]['indicator'] = trans($label.($v), []);
        } elseif ($type === 'process' && stripos((string) $v, '_') === true) {
            $average_contribution['data']['Average'][$i]['indicator'] = Common::get_all_indicator_labels_cached()[$v].' '.trans('imet-core::analysis_report.legends.'.$v);
            // Common::indicator_label($v, $label, 'imet-core::analysis_report.legends.');
        } else {
            $average_contribution['data']['Average'][$i]['indicator'] = Common::get_all_indicator_labels_cached()[$v]; // Common::indicator_label($v, $label);
        }

        return $average_contribution;
    }
}
