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

namespace ImetCore\Models\Imet\API\ScalingUp;

use ImetCore\Models\Imet\ScalingUp\ScalingUpAnalysis;

trait GeneralInfo
{
    /**
     * @throws \ReflectionException
     */
    public static function get_general_info(array $parameters, string $language = 'en'): array
    {
        $labels = [
            'network' => trans('imet-core::analysis_report.general_info.network'),
            'countries' => trans('imet-core::analysis_report.general_info.country'),
            'eco_regions' => trans('imet-core::analysis_report.general_info.ecoregions'),
            'total_surface_protected_areas' => trans('imet-core::analysis_report.general_info.total_surface_protected'),
            'local_mission' => trans('imet-core::analysis_report.general_info.mission'),
            'local_objective' => trans('imet-core::analysis_report.general_info.objectives'),
            'local_vision' => trans('imet-core::analysis_report.general_info.vision'),
        ];

        $api = ScalingUpAnalysis::general_info($parameters);

        return ['data' => $api['data']['general_info'], 'labels' => $labels];
    }
}
