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
use ImetCore\Models\Imet\ImetV2\Modules;

final class AverageContribution
{
    /**
     * @return array[]
     */
    public static function average_contribution_calculations_threat(array $form_ids, string $colors = '', array $options = [], string $label = '', string $type = ''): array
    {
        $indicators = [];
        $data = [];

        foreach ($form_ids as $form_id) {
            $stats = Modules\Context\MenacesPressions::getStats($form_id);

            if ($indicators === []) {
                $indicators = self::extractThreatIndicators($stats['categoryStats']);
            }

            $data = self::aggregateThreatData($stats['categoryStats'], $data);
        }

        self::sortDataIfNumericKeys($data);

        $average_contribution = self::calculate_data_average_contribution([], $data, $colors, $label, $type);
        $average_contribution['options'] = $options ?: null;
        $average_contribution['indicators'] = $indicators;

        self::sortAveragesByValue($average_contribution);

        $average_contribution['legends'] = [
            trans('imet-core::v2_common.steps.threats'),
            trans('imet-core::analysis_report.variability')
        ];

        return ['average_contribution' => $average_contribution];
    }

    private static function extractThreatIndicators(array $categoryStats): array
    {
        $indicators = [];
        foreach (array_keys($categoryStats) as $index) {
            $indicators[] = trans('imet-core::v2_context.MenacesPressions.categories.title' . ($index + 1), []);
        }

        return array_reverse($indicators);
    }

    private static function aggregateThreatData(array $categoryStats, array $data): array
    {
        foreach ($categoryStats as $key => $value) {
            $processedValue = ($value === '')
                ? '-'
                : Common::round_number(-1 * (float)$value);

            $data[$key][] = $processedValue;
        }

        return $data;
    }

    private static function sortDataIfNumericKeys(array &$data): void
    {
        if (array_filter(array_keys($data), is_string(...)) === []) {
            krsort($data);
        }
    }

    private static function sortAveragesByValue(array &$average_contribution): void
    {
        if (isset($average_contribution['data']['Average'])) {
            usort($average_contribution['data']['Average'], fn(array $a, array $b): int => $b['value'] <=> $a['value']);
        }
    }

    /**
     * @return array[]
     */
    public static function average_contribution_calculations(array $form_ids, array $table_indicators, string $type = '', string $colors = '', array $options = [], string $label = '', string $origType = ''): array
    {
        $filtered = Common::filtered_indicators_and_round_values($form_ids, $type, $table_indicators);
        $data = self::aggregateIndicatorData($filtered);

        self::sortDataIfNumericKeys($data);

        $average_contribution = self::calculate_data_average_contribution([], $data, $colors, $label, $type);
        $average_contribution['options'] = $options ?: null;
        $average_contribution['legends'] = [
            self::getLegendName($origType),
            trans('imet-core::analysis_report.variability')
        ];

        return ['average_contribution' => $average_contribution];
    }

    private static function aggregateIndicatorData(array $filtered): array
    {
        $data = [];
        $negativeIndicators = ['C2', 'OC2', 'OC3'];
        $zeroNegativeIndicators = ['C3'];

        foreach ($filtered as $values) {
            unset($values['indicators_number'], $values['avg']);

            foreach ($values as $indicator => $value) {
                $correctedValue = self::applyValueCorrection($indicator, $value, $negativeIndicators, $zeroNegativeIndicators);
                $data[$indicator][] = $correctedValue;
            }
        }

        return $data;
    }

    private static function applyValueCorrection(string $indicator, mixed  $value, array  $negativeIndicators, array  $zeroNegativeIndicators): mixed
    {
        if (in_array($indicator, $negativeIndicators) || in_array($indicator, $zeroNegativeIndicators)) {
            return Common::values_correction($indicator, (float)$value);
        }

        return $value;
    }

    private static function getLegendName(string $origType): string
    {
        $processLegends = [
            'process_PRA' => 'PRA',
            'process_PRB' => 'PRB',
            'process_PRC' => 'PRC',
            'process_PRD' => 'PRD',
            'process_PRE' => 'PRE',
            'process_PRF' => 'PRF',
        ];

        if (str_contains($origType, '_')) {
            return trans('imet-core::analysis_report.guidance.process.' . $processLegends[$origType].'.intro');
        }

        return trans('imet-core::common.steps_eval.' . $origType);
    }


    private static function calculate_data_average_contribution(array $average_contribution, array $data, string $colors, string $label, string $type): array
    {
        $i = 0;

        foreach ($data as $index => $value) {
            if ($value !== '-') {

                $v = $index;

                if (is_numeric($index)) {
                    $v = (int)$index + 1;
                }

                $values = array_filter(array_values($value), is_numeric(...));
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
            'label' => trans('imet-core::v2_common.assessment.' . $v),
            'color' => '#000000',
            'itemStyle' => ['color' => $colors],
        ];

        if (is_numeric($index)) {
            $average_contribution['data']['Average'][$i]['indicator'] = trans($label . ($v), []);
        } elseif ($type === 'process' && stripos((string)$v, '_') === true) {
            $average_contribution['data']['Average'][$i]['indicator'] = Common::get_all_indicator_labels_cached()[$v] . ' ' . trans('imet-core::analysis_report.legends.' . $v);
            // Common::indicator_label($v, $label, 'imet-core::analysis_report.legends.');
        } else {
            $average_contribution['data']['Average'][$i]['indicator'] = Common::get_all_indicator_labels_cached()[$v]; // Common::indicator_label($v, $label);
        }

        return $average_contribution;
    }
}
