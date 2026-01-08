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

use ImetCore\Models\Imet\ScalingUp\Analysis\DataProviders\ManagementContextDataProvider;

/**
 * Handles management context analysis
 */
final class ManagementContextAnalysis extends BaseAnalysis
{
    public static string $template = 'key_elements_of_conservation';
    public static string $title = 'imet-core::analysis_report.sections.third';
    public static string $code = '3';
    public static string $info_label = 'imet-core::analysis_report.guidance.key_elements';

    private static function getManagementContextProvider(?int $scalingId = null): ManagementContextDataProvider
    {
        return new ManagementContextDataProvider($scalingId ?? self::$scaling_id);
    }

    /**
     * Get management context for protected areas by form ids
     */
    public static function getManagementContext(array $form_ids): array
    {
        $provider = self::getManagementContextProvider();
        $keyElements = $provider->getManagementContext($form_ids);

        return self::successResponse(['key_elements' => $keyElements]);
    }
}

