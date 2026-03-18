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

namespace ImetCore\Models\Imet\v2\Modules\Report;

use ImetCore\Models\Imet\v2\Modules\Component\ImetModule_Report;

final class ManagementEffectivenessAnalysis extends ImetModule_Report
{
    protected $table = 'report_management_effectiveness_analysis';

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'SIMPLE';
        $this->module_title = trans('imet-core::v2_report.ManagementEffectivenessAnalysis.title');
        $this->module_fields = [
            ['name' => 'analysis',          'type' => 'text-editor'],
            ['name' => 'strengths',         'type' => 'text-editor',     'label' => trans('imet-core::v2_report.ManagementEffectivenessAnalysis.fields.strengths')],
            ['name' => 'weaknesses',        'type' => 'text-editor',     'label' => trans('imet-core::v2_report.ManagementEffectivenessAnalysis.fields.weaknesses')],
            ['name' => 'opportunities',     'type' => 'text-editor',     'label' => trans('imet-core::v2_report.ManagementEffectivenessAnalysis.fields.opportunities')],
            ['name' => 'threats',            'type' => 'text-editor',     'label' => trans('imet-core::v2_report.ManagementEffectivenessAnalysis.fields.threats')],
        ];

        parent::__construct($attributes);
    }

}
