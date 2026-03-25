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

final class DataTable
{
    /**
     * @return array[]
     */
    public static function get_datatable_analysis_indicators(array $form_ids, array $table_indicators, string $type = '', ?int $scaling_id = 0, bool $add_synthetic_indicator = false): array
    {
        $filtered = Common::filtered_indicators_and_round_values($form_ids, $type, $table_indicators, $add_synthetic_indicator);
        $average = self::initializeAverage($table_indicators);
        $tableRows = [];

        foreach ($filtered as $id => $values) {
            $tableRows[] = self::buildProtectedAreaRow($id, $values, $scaling_id);
            $average = self::accumulateValues($average, $values, $table_indicators);
        }

        $tableRows[] = self::calculateFinalAverage($average, $table_indicators, count($filtered));

        return ['table' => $tableRows];
    }

    private static function initializeAverage(array $table_indicators): array
    {
        $averageLabel = trans('imet-core::analysis_report.average');

        return ['wdpa_id' => $averageLabel, 'name' => $averageLabel] + array_map(fn (): int => 0, $table_indicators);
    }

    private static function buildProtectedAreaRow(int $id, array $values, ?int $scaling_id): array
    {
        $pa = Common::get_pa_name($id, $scaling_id);
        $indicators = array_diff_key($values, ['indicators_number' => 0]);

        return [
            'wdpa_id' => $pa->wdpa_id,
            'name' => $pa->name,
            ...array_map(Common::round_number(...), $indicators),
        ];
    }

    private static function accumulateValues(array $average, array $values, array $table_indicators): array
    {
        foreach (array_keys($table_indicators) as $indicator) {
            $value = ($values[$indicator] === '-') ? 0 : (float) $values[$indicator];
            $average[$indicator] += $value;
        }

        return $average;
    }

    private static function calculateFinalAverage(array $average, array $table_indicators, int $count): array
    {
        foreach (array_keys($table_indicators) as $indicator) {
            $average[$indicator] = Common::round_number($average[$indicator] / $count);
        }

        return $average;
    }
}
