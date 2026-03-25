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

use ImetCore\Models\Imet\ScalingUp\Analysis\DataProviders\ManagementCycleDataProvider;
use ImetCore\Models\Imet\ScalingUp\Analysis\DataProviders\ThreatsDataProvider;

/**
 * Handles management cycle analysis
 */
final class ManagementCycleAnalysis extends BaseAnalysis
{
    public static string $template = 'analysis_per_element_of_them_management_cycle';

    public static string $title = 'imet-core::analysis_report.sections.sixth';

    public static string $code = '6';

    public static string $exclude_elements = '';

    public static string $info_label = 'imet-core::analysis_report.guidance.analysis_per_element';

    private static function getManagementCycleProvider(?int $scalingId = null): ManagementCycleDataProvider
    {
        return new ManagementCycleDataProvider($scalingId ?? self::$scaling_id);
    }

    private static function getThreadsProvider(?int $scalingId = null): ThreatsDataProvider
    {
        return new ThreatsDataProvider($scalingId ?? self::$scaling_id);
    }

    /**
     * Analysis per element of the management cycle
     */
    public static function analysisPerElementOfTheManagementCycle(array $form_ids): array
    {
        $type = array_pop($form_ids);

        return self::getManagementCycleProvider()->getAnalysisPerElement($form_ids, $type);
    }

    public static function data(array $params = []): array
    {
        return self::getThreadsProvider()->getThreatsCategoriesAnalysis($params['form_ids']);
    }
}
