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

use ImetCore\Models\Imet\ScalingUp\Charts\AverageContribution;
use ImetCore\Models\Imet\ScalingUp\Charts\Radar;
use ImetCore\Models\Imet\ScalingUp\Charts\Ranking;

final class ThreatsDataProvider implements DataProviderInterface
{
    private const string DEFAULT_COLOR = '#C23531';
    private const array DEFAULT_OPTIONS = ['height' => '850px'];
    private const string DEFAULT_TRANSLATION_KEY = 'imet-core::v2_context.MenacesPressions.categories.title';

    public function __construct(
        private int $scalingId
    )
    {
    }

    /**
     * Get threats categories analysis for protected areas
     */
    public function getThreatsCategoriesAnalysis(array $formIds, ?string $color = null, ?array $options = null, ?string $translationKey = null): array
    {
        $color = $color ?? self::DEFAULT_COLOR;
        $options = $options ?? self::DEFAULT_OPTIONS;
        $translationKey = $translationKey ?? self::DEFAULT_TRANSLATION_KEY;

        return [
            'values' => $this->getThreatsValues($formIds),
            'average_contribution' => $this->getAverageContribution($formIds, $color, $options, $translationKey),
            'ranking' => $this->getRanking($formIds),
            'radar' => $this->getRadarData($formIds),
        ];
    }

    /**
     * Get threats values (total categories)
     */
    private function getThreatsValues(array $formIds): array
    {
        $radarData = Radar::get_threats_radar_indicators($formIds, $this->scalingId);
        return $radarData['total_categories'];
    }

    /**
     * Get average contribution analysis for threats
     */
    private function getAverageContribution(array $formIds, string $color, array $options, string $translationKey): array
    {
        $result = AverageContribution::average_contribution_calculations_threat(
            $formIds,
            $color,
            $options,
            $translationKey,
            ''
        );

        return $result['average_contribution'];
    }

    /**
     * Get ranking data for threats indicators
     */
    private function getRanking(array $formIds): array
    {
        return Ranking::ranking_threats_indicators($formIds, $this->scalingId);
    }

    /**
     * Get radar diagram data for threats
     */
    private function getRadarData(array $formIds): array
    {
        $radarData = Radar::get_threats_radar_indicators($formIds, $this->scalingId);
        return $radarData['radar'];
    }
}

