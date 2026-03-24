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

use Illuminate\Support\Facades\App;
use ImetCore\Helpers\ScalingUp\Common;
use ImetCore\Models\Imet\ScalingUp\ScalingUpAnalysis;
use ImetCore\Models\Imet\ImetV2\Modules;

final class Ranking
{
    /**
     * @return array|array[]
     */
    public static function ranking_indicators(array $form_ids, string $type, array $indicators, ?int $scaling_id = 0): array
    {
        $ranking = self::initializeRanking();
        $aggregation = self::initializeAggregation();

        $filtered = self::getFilteredData($form_ids, $type, $indicators);

        foreach ($filtered as $id => $values) {
            $pa = Common::get_pa_name($id, $scaling_id);
            $values = self::cleanValues($values);

            $paIndex = count($ranking['xAxis']);
            $ranking['xAxis'][$paIndex] = $pa->name;
            $ranking['wdpa_ids'][$paIndex] = $pa->wdpa_id;

            self::processIndicators(
                $values,
                $type,
                $id,
                $filtered,
                $paIndex,
                $ranking,
                $aggregation
            );
        }

        return self::get_values_ranking(
            $ranking,
            $aggregation['sum_values'],
            $aggregation['separated_values'],
            $aggregation['percent_values'],
            $aggregation['items_to_calculate']
        );
    }

    /**
     * @return array[]
     */
    private static function initializeRanking(): array
    {
        return [
            'values' => [],
            'legends' => [],
            'xAxis' => [],
            'wdpa_ids' => [],
            'actual_value' => []
        ];
    }

    /**
     * @return array[]
     */
    private static function initializeAggregation(): array
    {
        return [
            'items_to_calculate' => [],
            'percent_values' => [],
            'sum_values' => [],
            'separated_values' => []
        ];
    }

    private static function getFilteredData(array $form_ids, string $type, array $indicators): array
    {
        if (isset($indicators['PRE'])) {
            [$filtered, $indicators_numbers] = self::process_subindicators_for_ranking_protected_areas($form_ids, $type);
            return $filtered;
        }

        return Common::filtered_indicators_and_round_values($form_ids, $type, $indicators);
    }

    private static function cleanValues(array $values): array
    {
        unset($values['avg'], $values['indicators_number']);
        return $values;
    }

    private static function processIndicators(
        array  $values,
        string $type,
        int    $id,
        array  $filtered,
        int    $paIndex,
        array  &$ranking,
        array  &$aggregation
    ): void
    {
        $aggregation['items_to_calculate'][$paIndex] ??= 0;
        $aggregation['sum_values'][$paIndex] ??= 0;

        $indicatorsCount = count(array_filter($values));
        $processNumbers = self::getProcessNumbers($filtered, $id);

        foreach ($values as $indicator => $value) {
            $name = self::getIndicatorName($indicator, $type);
            $correctedValue = self::getCorrectedValue($indicator, $value, $indicatorsCount, $processNumbers);

            $ranking['legends'][$indicator] = $name;
            $ranking['actual_value'][$name][] = $correctedValue;

            if ((string)$correctedValue !== '-') {
                $aggregation['items_to_calculate'][$paIndex]++;
                $aggregation['separated_values'][$paIndex][] = $correctedValue;
                $aggregation['sum_values'][$paIndex] += $correctedValue;
            } else {
                $aggregation['separated_values'][$paIndex][] = ScalingUpAnalysis::UNDEFINED_VALUE;
            }
        }
    }

    private static function getProcessNumbers(array $filtered, int $id): array
    {
        // Check if we have process sub-indicators (when filtered contains indicators_numbers)
        if (isset($filtered[$id]) && is_array($filtered[$id])) {
            return $filtered[$id]['indicators_numbers'] ?? [];
        }

        return [];
    }

    private static function getIndicatorName(string $indicator, string $type): string
    {
        $labels = Common::get_all_indicator_labels_cached();
        $baseName = $labels[$indicator] ?? $indicator;

        if ($type === 'process' && str_contains($indicator, '_')) {
            return $baseName . ' _' . trans('imet-core::analysis_report.legends.' . $indicator);
        }

        return $baseName;
    }

    private static function getCorrectedValue(string $indicator, mixed $value, int $indicatorsCount, array $processNumbers): mixed
    {
        if ($processNumbers !== []) {
            $corrected = Common::values_correction($indicator, $value);
            return Common::ranking_values_correction($corrected, $indicatorsCount, $processNumbers, $indicator);
        }

        return Common::values_correction($indicator, $value);
    }

    /**
     * @return array|array[]
     */
    private static function get_values_ranking(
        array $ranking,
        array $sum_values,
        array $separated_values_by_pa,
        array $percent_values,
        array $items_to_calculate = []
    ): array
    {
        $indicatorKeys = array_keys($ranking['actual_value']);

        // Calculate percent values for each PA
        $percent_values = self::calculatePercentValues($separated_values_by_pa, $sum_values, $indicatorKeys);

        // Calculate average values per PA
        $average_values = self::calculateAverageValues($sum_values, $items_to_calculate);

        // Calculate ranking values based on percentages and averages
        $ranking = self::calculateRankingValues($ranking, $percent_values, $average_values);

        // Reorder all data by average values (descending)
        arsort($average_values);

        return self::buildReorderedRanking($ranking, $average_values, $separated_values_by_pa, $percent_values);
    }

    private static function calculatePercentValues(
        array $separated_values_by_pa,
        array $sum_values,
        array $indicatorKeys
    ): array
    {
        $percent_values = [];

        foreach ($separated_values_by_pa as $paIndex => $values) {
            $total = ($sum_values[$paIndex] == 0) ? 1 : $sum_values[$paIndex];

            foreach ($values as $indicatorIndex => $value) {
                $percentValue = ($value != ScalingUpAnalysis::UNDEFINED_VALUE)
                    ? Common::round_number(($value / $total) * 100)
                    : $value;

                $percent_values[$indicatorKeys[$indicatorIndex]][$paIndex] = $percentValue;
            }
        }

        return $percent_values;
    }

    private static function calculateAverageValues(array $sum_values, array $items_to_calculate): array
    {
        return array_map(
            fn($value, $index): float|string|int => $items_to_calculate[$index] > 0
                ? Common::round_number($value / $items_to_calculate[$index])
                : 0,
            $sum_values,
            array_keys($sum_values)
        );
    }

    private static function calculateRankingValues(
        array $ranking,
        array $percent_values,
        array $average_values
    ): array
    {
        foreach ($percent_values as $indicator => $values) {
            foreach ($values as $paIndex => $percentValue) {
                if ($percentValue !== ScalingUpAnalysis::UNDEFINED_VALUE && isset($average_values[$paIndex])) {
                    $ranking['values'][$indicator][$paIndex] = Common::round_number(
                        ($percentValue / 100) * $average_values[$paIndex]
                    );
                } else {
                    $ranking['values'][$indicator][$paIndex] = $percentValue;
                }
            }
        }

        return $ranking;
    }

    /**
     * @return array[]
     */
    private static function buildReorderedRanking(
        array $ranking,
        array $average_values,
        array $separated_values_by_pa,
        array $percent_values
    ): array
    {
        $new_ranking = self::initializeRanking();
        $reorder_separated_values_by_pa = [];
        $reorder_percent_values = [];

        $newIndex = 0;
        foreach (array_keys($average_values) as $oldIndex) {
            foreach ($ranking['values'] as $indicator => $items) {
                $new_ranking['values'][$indicator][$newIndex] = $items[$oldIndex] ?? ScalingUpAnalysis::UNDEFINED_VALUE;
                $new_ranking['actual_value'][$indicator][$newIndex] = $ranking['actual_value'][$indicator][$oldIndex] ?? ScalingUpAnalysis::UNDEFINED_VALUE;
                $reorder_percent_values[$indicator][$newIndex] = $percent_values[$indicator][$oldIndex] ?? ScalingUpAnalysis::UNDEFINED_VALUE;
            }

            $new_ranking['xAxis'][$newIndex] = $ranking['xAxis'][$oldIndex];
            $new_ranking['wdpa_ids'][$newIndex] = $ranking['wdpa_ids'][$oldIndex];
            $reorder_separated_values_by_pa[$newIndex] = $separated_values_by_pa[$oldIndex] ?? [];

            $newIndex++;
        }

        $new_ranking['legends'] = $ranking['legends'];
        $new_ranking['percent_value'] = $reorder_percent_values;
        $new_ranking['raw_values_protected_area'] = $reorder_separated_values_by_pa;

        return $new_ranking;
    }

    /**
     * @return array[]
     */
    private static function process_subindicators_for_ranking_protected_areas(array $form_ids, string $type): array
    {
        $overall_ranking = [
            'PRA' => ['PR1' => [], 'PR2' => [], 'PR3' => [], 'PR4' => [], 'PR5' => [], 'PR6' => []],
            'PRB' => ['PR7' => [], 'PR8' => [], 'PR9' => []],
            'PRC' => ['PR10' => [], 'PR11' => [], 'PR12' => []],
            'PRD' => ['PR13' => [], 'PR14' => []],
            'PRE' => ['PR15' => [], 'PR16' => []],
            'PRF' => ['PR17' => [], 'PR18' => []],
        ];

        $indicators_numbers = [];
        $indicators_average = [];

        foreach ($overall_ranking as $key => $value) {
            $indicators_average[$key] = Common::filtered_indicators_and_round_values($form_ids, $type, $value);
        }

        $filtered_indicators = [];

        foreach ($indicators_average as $key => $item) {
            foreach ($form_ids as $form_id) {
                $form_values = $item[$form_id];

                $filtered_indicators[$form_id][$key] = $form_values['avg'];
                $indicators_numbers[$form_id][$key] = $form_values['indicators_number'];
            }
        }

        return [$filtered_indicators, $indicators_numbers];
    }

    /**
     * @return array[]
     */
    public static function ranking_threats_indicators(array $form_ids, int $scaling_id = 0): array
    {
        $locale = App::getLocale();
        $ranking = ['values' => [], 'legends' => [], 'xAxis' => [], 'xAxisx' => [], 'wdpa_ids' => []];
        $items_to_calculate = [];
        $ranking_raw_values = [];
        $separated_values_by_pa = [];
        $sum_values = [];
        $percent_values = [];
        $protected_areas = [];
        foreach ($form_ids as $j => $form_id) {
            $pa = Common::get_pa_name($form_id, $scaling_id);
            $protected_areas[$j] = Modules\Context\MenacesPressions::getStats($form_id);
            $wdpa_id = $pa->wdpa_id;

            foreach ($protected_areas[$j]['categoryStats'] as $k => $protected_area) {
                if (!isset($sum_values[$j])) {
                    $sum_values[$j] = 0;
                }

                if (!isset($items_to_calculate[$j])) {
                    $items_to_calculate[$j] = 0;
                }

                App::setLocale($locale);
                $name = trans('imet-core::v2_context.MenacesPressions.categories.title' . ($k + 1), []);

                if ($protected_area === '') {
                    $value = ScalingUpAnalysis::UNDEFINED_VALUE;
                } else {
                    $items_to_calculate[$j] += 1;
                    $value = Common::round_number((-1 * (float)$protected_area));
                    $sum_values[$j] += (float)($value);
                }

                $separated_values_by_pa[$j][] = $value;
                $ranking_raw_values[$name][] = $ranking['actual_value'][$name][] = $value;
                $ranking['legends'][$name] = $name;
            }

            $ranking['xAxis'][$j] = $pa->name;
            $ranking['wdpa_ids'][$j] = $wdpa_id;
        }

        return self::get_values_ranking($ranking, $sum_values, $separated_values_by_pa, $percent_values, $items_to_calculate);
    }

    public static function get_overall_ranking(array $form_ids, array $assessment = []): array
    {
        $items = $assessment ?: Common::get_assessments($form_ids);

        self::sortAssessmentsByIndex($items['assessments']);

        $ranking = self::buildOverallRankingData($items['assessments'], $form_ids);

        return  ['values' => $ranking, 'form_ids' => $form_ids];
    }

    private static function sortAssessmentsByIndex(array &$assessments): void
    {
        usort($assessments, fn(array $first, array $second): int => $first['imet_index'] <=> $second['imet_index']);
    }

    /**
     * @return array[]
     */
    private static function buildOverallRankingData(array $assessments, array &$form_ids): array
    {
        $indicatorTypes = ['context', 'planning', 'inputs', 'process', 'outputs', 'outcomes'];
        $ranking = [
            'values' => [],
            'percent_values' => [],
            'legends' => [],
            'xAxis' => [],
            'actual_value' => [],
            'raw_values' => [],
        ];

        $paIndex = 0;
        foreach ($assessments as $assessment) {
            $name = $assessment['name'];
            $form_ids[$name] = $assessment['wdpa_id'];
            $ranking['xAxis'][] = $name;

            $indicatorValues = self::extractIndicatorValues($assessment, $indicatorTypes);
            $ranking['raw_values'][$paIndex] = array_values($indicatorValues);
            $total = array_sum($indicatorValues);

            self::processOverallIndicators(
                $indicatorTypes,
                $indicatorValues,
                $total,
                $assessment['imet_index'],
                $ranking
            );

            $paIndex++;
        }

        return $ranking;
    }

    private static function extractIndicatorValues(array $assessment, array $indicatorTypes): array
    {
        $values = [];
        foreach ($indicatorTypes as $type) {
            $values[$type] = Common::round_number($assessment[$type]);
        }

        return $values;
    }

    private static function processOverallIndicators(
        array $indicatorTypes,
        array $indicatorValues,
        float $total,
        float $imetIndex,
        array &$ranking
    ): void
    {
        foreach ($indicatorTypes as $type) {
            $label = trans('imet-core::common.steps_eval.' . $type);
            $value = $indicatorValues[$type];

            $ranking['legends'][$type] = $label;
            $ranking['actual_value'][$label][] = $value;

            if ($total === 0) {
                $ranking['percent_values'][$label][] = '-';
                $ranking['values'][$label][] = '-';
            } else {
                $percentValue = Common::round_number(($value / $total) * 100);
                $ranking['percent_values'][$label][] = $percentValue;
                $ranking['values'][$label][] = Common::round_number(($percentValue / 100) * $imetIndex);
            }
        }
    }
}
