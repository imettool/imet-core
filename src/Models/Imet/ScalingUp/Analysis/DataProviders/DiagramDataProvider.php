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

use Illuminate\Support\Facades\App;
use ImetCore\Models\Imet\ScalingUp\Charts\Radar;

final readonly class DiagramDataProvider implements DataProviderInterface
{
    public function __construct(
        private int $scalingId
    ) {}

    /**
     * Get averages of each indicator of six elements with styling and limits
     */
    public function getAveragesOfEachIndicatorOfSixElements(
        array $formIds,
        array $assessments = [],
        bool $overall = false
    ): array {
        $locale = App::getLocale();
        $data = Radar::get_radar_indicators($formIds, false, $assessments, $overall, $this->scalingId);

        $average = $data['diagrams']['Average'];
        $upperLimit = $data['diagrams']['upper limit'];
        $lowerLimit = $data['diagrams']['lower limit'];

        App::setLocale($locale);

        return [
            'Average' => $this->buildIndicatorsList($average, $lowerLimit, $upperLimit),
            'legends' => [
                'Synthetic indicators',
                'Variability',
            ],
        ];
    }

    /**
     * Build the indicators list with styling configuration
     */
    private function buildIndicatorsList(array $average, array $lowerLimit, array $upperLimit): array
    {
        $indicators = [
            [
                'key' => 'outcomes',
                'translation' => 'imet-core::common.steps_eval.outcomes',
                'color' => '#00B050',
            ],
            [
                'key' => 'outputs',
                'translation' => 'imet-core::common.steps_eval.outputs',
                'color' => '#92D050',
            ],
            [
                'key' => 'process',
                'translation' => 'imet-core::common.steps_eval.process',
                'color' => '#0099CC',
            ],
            [
                'key' => 'inputs',
                'translation' => 'imet-core::common.steps_eval.inputs',
                'color' => '#ffc000',
            ],
            [
                'key' => 'planning',
                'translation' => 'imet-core::common.steps_eval.planning',
                'color' => '#bfbfbf',
            ],
            [
                'key' => 'context',
                'translation' => 'imet-core::common.steps_eval.context',
                'color' => '#ffff00',
            ],
        ];

        return array_map(function (array $indicator) use ($average, $lowerLimit, $upperLimit): array {
            $key = $indicator['key'];

            return [
                'value' => $average[$key],
                'upper limit' => [$lowerLimit[$key], $upperLimit[$key]],
                'indicator_raw' => $key,
                'indicator' => trans($indicator['translation']),
                'itemStyle' => ['color' => $indicator['color']],
            ];
        }, $indicators);
    }

    /**
     * Get protected areas radar data (for diagram compare)
     */
    public function getProtectedAreasDiagramCompare(
        array $formIds,
        array $assessments = [],
        bool $overall = false
    ): array {
        $data = Radar::get_radar_indicators($formIds, false, $assessments, $overall, $this->scalingId);
        unset($data['diagrams']['upper limit']);
        unset($data['diagrams']['lower limit']);

        return $data;
    }
}
