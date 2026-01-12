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
use ImetCore\Models\Imet\ScalingUp\ScalingUpWdpa;
use ImetCore\Models\Imet\ScalingUp\Charts\Ranking;

final class OverallManagementEffectivenessDataProvider
{
    private DiagramDataProvider $diagramProvider;
    private GroupingDataProvider $groupingProvider;

    public function __construct(
        private int $scalingId
    ) {
        $this->diagramProvider = new DiagramDataProvider($scalingId);
        $this->groupingProvider = new GroupingDataProvider($scalingId);
    }

    /**
     * Get overall management effectiveness scores for protected areas
     */
    public function getOverallManagementEffectivenessScores(array $formIds): array
    {
        $assessments = $this->getAssessments($formIds);

        return [
            'ranking' => $this->getRanking($formIds, $assessments),
            'averages_six_elements' => $this->getAveragesSixElements($formIds, $assessments),
            'radar' => $this->getRadarData($formIds, $assessments),
            'scatter' => $this->getScatterData($formIds, $assessments),
            'assessments' => $this->getAssessmentsAverage($assessments),
        ];
    }

    /**
     * Get assessments data from common helper
     */
    private function getAssessments(array $formIds): array
    {
        return $syntheticIndicatorsTable = Common::get_assessments($formIds, $this->scalingId);
    }

    /**
     * Get overall ranking data
     */
    private function getRanking(array $formIds, array $assessments): array
    {
        $indexRanking = Ranking::get_overall_ranking($formIds, $assessments);
        return $indexRanking['values'];
    }

    /**
     * Get averages of six elements
     */
    private function getAveragesSixElements(array $formIds, array $assessments): array
    {
        return $this->diagramProvider->getAveragesOfEachIndicatorOfSixElements(
            $formIds,
            $assessments,
            true
        );
    }

    /**
     * Get radar diagram data
     */
    private function getRadarData(array $formIds, array $assessments): array
    {
        $radars = $this->diagramProvider->getProtectedAreasDiagramCompare(
            $formIds,
            $assessments,
            true
        );
        return $radars['diagrams'];
    }

    /**
     * Get scatter plot data
     */
    private function getScatterData(array $formIds, array $assessments): array
    {
        Common::reset_areas_ids();

        $parameters = $this->buildScatterParameters($formIds);

        $scatterPlots = $this->groupingProvider->getScatterData(
            $parameters,
            $assessments,
            true
        );

        return $scatterPlots['scatter'];
    }

    /**
     * Build parameters for scatter plot
     */
    private function buildScatterParameters(array $formIds): array
    {
        return array_map(function (int $formId): array {
            $pa = ScalingUpWdpa::getCustomNames($formId, $this->scalingId);
            return [
                'id' => $formId,
                'group' => $formId,
                'name' => $pa['name'],
                'color' => $pa['color']
            ];
        }, $formIds);
    }

    /**
     * Get assessments average data
     */
    private function getAssessmentsAverage(array $assessments): array
    {
        return $assessments['assessments_average'];
    }
}

