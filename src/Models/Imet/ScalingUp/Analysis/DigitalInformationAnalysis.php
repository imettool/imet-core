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

final class DigitalInformationAnalysis extends BaseAnalysis
{
    public static string $template = 'additional_option_digital_information_per_pa';
    public static string $title = 'imet-core::analysis_report.sections.eighth';
    public static string $code = '8';
    public static string $exclude_elements = '';
    public static string $info_label = 'imet-core::analysis_report.guidance.additional_options.main';

    public static function data(array $params = []): array
    {
        return [];
    }
}

