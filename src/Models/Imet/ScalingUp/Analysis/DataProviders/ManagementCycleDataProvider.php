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

namespace ImetCore\Models\Imet\ScalingUp\Analysis\DataProviders;

use ImetCore\Helpers\ScalingUp\Common;
use ImetCore\Models\Imet\ScalingUp\Charts\AverageContribution;
use ImetCore\Models\Imet\ScalingUp\Charts\DataTable;
use ImetCore\Models\Imet\ScalingUp\Charts\Radar;
use ImetCore\Models\Imet\ScalingUp\Charts\Ranking;

final readonly class ManagementCycleDataProvider implements DataProviderInterface
{
    private const array OPTIONS = [
        'context' => ['height' => '500px'],
        'planning' => ['height' => '500px'],
        'inputs' => ['height' => '500px'],
        'process' => ['height' => '500px'],
        'outputs' => ['height' => '500px'],
        'outcomes' => ['height' => '500px'],
        'context_sub_indicators' => ['height' => '500px'],
        'process_sub_indicators' => ['height' => '500px'],
    ];

    private const array COLORS = [
        'context' => '#ffff00',
        'planning' => '#bfbfbf',
        'inputs' => '#ffc000',
        'process' => '#0099CC',
        'outputs' => '#92D050',
        'outcomes' => '#00B050',
        'context_sub_indicators' => '#ffff00',
        'process_sub_indicators' => '#0099CC',
    ];

    private const array TABLE_INDICATORS = [
        'context' => [
            'main' => ['C1', 'C2', 'C3'],
            'context_value_and_importance' => ['C11', 'C12', 'C13', 'C14', 'C15'],
        ],
        'planning' => [
            'main' => ['P1', 'P2', 'P3', 'P4', 'P5', 'P6'],
        ],
        'inputs' => [
            'main' => ['I1', 'I2', 'I3', 'I4', 'I5'],
        ],
        'process' => [
            'process_sub_indicators' => ['PRE', 'PRC', 'PRD', 'PRF', 'PRA', 'PRB'],
        ],
        'process_PRA' => [
            'process_internal_management' => ['PR1', 'PR2', 'PR3', 'PR4', 'PR5', 'PR6'],
        ],
        'process_PRB' => [
            'process_management_protection_values' => ['PR7', 'PR8', 'PR9'],
        ],
        'process_PRC' => [
            'process_stakeholders_relationships' => ['PR10', 'PR11', 'PR12'],
        ],
        'process_PRD' => [
            'process_tourism_management' => ['PR13', 'PR14'],
        ],
        'process_PRE' => [
            'process_monitoring_and_research' => ['PR15', 'PR16'],
        ],
        'process_PRF' => [
            'process_effects_of_climate_change' => ['PR17', 'PR18'],
        ],
        'outputs' => [
            'main' => ['OP1', 'OP3', 'OP4'],
        ],
        'outcomes' => [
            'main' => ['OC1', 'OC2', 'OC3'],
        ],
    ];

    public function __construct(
        private int $scalingId
    ) {}

    /**
     * Get analysis per element of the management cycle
     */
    public function getAnalysisPerElement(array $formIds, string $type): array
    {
        $tableIndicators = $this->getTableIndicatorsForType($type);
        $origType = $this->extractOriginalType($type);

        $data = [];

        foreach ($tableIndicators as $indicatorKey => $indicators) {
            Common::reset_areas_ids();
            $data[$indicatorKey] = $this->getAnalysisDiagram(
                $formIds,
                $origType,
                $indicators,
                $type
            );
        }

        return [$type => $data];
    }

    /**
     * Get analysis diagram data for protected areas
     */
    private function getAnalysisDiagram(
        array $formIds,
        string $originalType,
        array $indicators,
        string $customType
    ): array {
        $options = self::OPTIONS[$originalType];
        $color = self::COLORS[$originalType];

        return [
            'radar' => $this->getRadarData($formIds, $indicators, $originalType, $color, $options),
            'table' => $this->getTableData($formIds, $indicators, $originalType),
            'ranking' => $this->getRankingData($formIds, $originalType, $indicators),
            'average_contribution' => $this->getAverageContribution($formIds, $indicators, $originalType, $color, $options, $customType),
        ];
    }

    /**
     * Get radar diagram data
     */
    private function getRadarData(
        array $formIds,
        array $indicators,
        string $type,
        string $color,
        array $options
    ): array {
        return Radar::get_radar_analysis_indicators(
            $formIds,
            $indicators,
            $type,
            $color,
            $options,
            '',
            $this->scalingId
        );
    }

    /**
     * Get datatable data
     */
    private function getTableData(array $formIds, array $indicators, string $type): array
    {
        $result = DataTable::get_datatable_analysis_indicators(
            $formIds,
            $indicators,
            $type,
            $this->scalingId,
            true
        );

        return $result['table'];
    }

    /**
     * Get ranking data
     */
    private function getRankingData(array $formIds, string $type, array $indicators): array
    {
        return Ranking::ranking_indicators($formIds, $type, $indicators, $this->scalingId);
    }

    /**
     * Get average contribution data
     */
    private function getAverageContribution(
        array $formIds,
        array $indicators,
        string $type,
        string $color,
        array $options,
        string $customType
    ): array {
        $result = AverageContribution::average_contribution_calculations(
            $formIds,
            $indicators,
            $type,
            $color,
            $options,
            'imet-core::analysis_report.assessment.',
            $customType
        );

        return $result['average_contribution'];
    }

    /**
     * Get table indicators for a specific type
     */
    private function getTableIndicatorsForType(string $type): array
    {
        if (!isset(self::TABLE_INDICATORS[$type])) {
            return [];
        }

        $indicators = self::TABLE_INDICATORS[$type];

        // Convert indicator keys to empty arrays
        return array_map(fn($group) => array_fill_keys($group, []), $indicators);
    }

    /**
     * Extract the original type from a composite type string
     */
    private function extractOriginalType(string $type): string
    {
        if (str_contains($type, 'process')) {
            $parts = explode('_', $type);
            return $parts[0];
        }

        return $type;
    }
}

