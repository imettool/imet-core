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


namespace ImetCore\Models\Imet\ScalingUp\Analysis;

use ImetCore\Models\Imet\ScalingUp\Analysis\DataProviders\AssessmentDataProvider;
use ImetCore\Models\Imet\ScalingUp\Analysis\DataProviders\ProtectedAreaDataProvider;
use ImetCore\Models\Imet\ScalingUp\Analysis\DataProviders\GroupingDataProvider;

final class GroupingAnalysis extends BaseAnalysis
{
    public static string $template = 'grouping_analysis_on_demand';
    public static string $title = 'imet-core::analysis_report.sections.fifth';
    public static string $code = '5';
    public static string $exclude_elements = 'js-grouping-action-buttons,start-zone,js-render-buttons';
    public static string $snapshot_id = 'grouping_analysis_on_demand';

    private static function getAssessmentProvider(): AssessmentDataProvider
    {
        return new AssessmentDataProvider(self::$scaling_id);
    }

    private static function getProtectedAreaProvider(): ProtectedAreaDataProvider
    {
        return new ProtectedAreaDataProvider(self::$scaling_id);
    }

    private static function getGroupingProvider(): GroupingDataProvider
    {
        return new GroupingDataProvider(self::$scaling_id);
    }

    public static function getAssessments(array $form_ids): array
    {
        return self::getAssessmentProvider()->getAssessments($form_ids);
    }

    public static function getProtectedAreaWithCountries(array $form_ids): array
    {
        $items = self::getProtectedAreaProvider()->getProtectedAreasWithCountries($form_ids);
        uasort($items, fn($a, $b) => strnatcmp($a['name'], $b['name']));
        return self::successResponse($items);
    }

    public static function getGroupingAnalysis(array $parameters, array $assessments = []): array
    {
        $radar = self::getGroupingProvider()->getRadarData($parameters, $assessments);
        return self::successResponse(['radar' => $radar]);
    }

    public static function getScatterGroupingAnalysis(array $parameters, array $assessments = [], bool  $not_grouped = false): array
    {
        return self::getGroupingProvider()->getScatterData($parameters, $assessments, $not_grouped);
    }
}


