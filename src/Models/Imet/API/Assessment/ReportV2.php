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

namespace ImetCore\Models\Imet\API\Assessment;

use Illuminate\Support\Facades\Lang;
use ImetCore\Models\Imet\v2\Modules\Context\Areas;
use ImetCore\Models\Imet\v2\Modules\Context\GeneralInfo;
use ImetCore\Models\Imet\v2\Report;

class ReportV2 extends ReportV1
{
    protected static string $report_class = Report::class;

    protected static string $general_info_class = GeneralInfo::class;

    protected static string $areas_class = Areas::class;

    #[\Override]
    protected static function get_labels(): array
    {
        $general_info_labels = trans('imet-core::v2_context.GeneralInfo.fields');
        $steps_eval_labels = trans('imet-core::common.steps_eval');
        $mission_labels = Lang::get('imet-core::v2_context.Missions.fields');
        $assessment_labels = Lang::get('imet-core::analysis_report.assessment');

        unset($general_info_labels['WDPA']);
        unset($steps_eval_labels['objectives']);
        unset($steps_eval_labels['management_effectiveness']);
        unset($steps_eval_labels['general_info']);
        unset($assessment_labels['ctx101']);
        unset($assessment_labels['ctx102']);

        return array_merge($steps_eval_labels, $general_info_labels, $mission_labels, $assessment_labels);
    }
}
