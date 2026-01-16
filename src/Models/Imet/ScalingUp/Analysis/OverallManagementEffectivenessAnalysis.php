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

use ImetCore\Models\Imet\ScalingUp\Analysis\DataProviders\OverallManagementEffectivenessDataProvider;

/**
 * Handles management effectiveness analysis
 */
final class OverallManagementEffectivenessAnalysis extends BaseAnalysis
{
    public static string $template = 'overall_management_effectiveness_scores';
    public static string $title = 'imet-core::analysis_report.sections.fourth';
    public static string $code = '4';
    public static string $info_label = 'imet-core::analysis_report.guidance.overall';

    private static function getOverallManagementEffectivenessProvider(?int $scalingId = null): OverallManagementEffectivenessDataProvider
    {
        return new OverallManagementEffectivenessDataProvider($scalingId ?? self::$scaling_id);
    }

    public static function data(array $params = []): array
    {
        return self::getOverallManagementEffectivenessProvider()->getOverallManagementEffectivenessScores($params['form_ids']);
    }

}

