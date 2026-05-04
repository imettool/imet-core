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

namespace ImetCore\Models\Imet\ImetV2\Modules\Report;

use ImetCore\Models\Imet\ImetV2\Modules\Component\ImetModule_Report;
use ModularForms\Enums\ModuleTypes;

final class InitialPlanningOptions extends ImetModule_Report
{
    protected $table = 'report_initial_planning_options';

    public function __construct(array $attributes = [])
    {
        $this->module_type = ModuleTypes::TABLE;
        $this->module_title = trans('imet-core::v2_report.InitialPlanningOptions.title');
        $this->module_code = 'RP 4C';

        $this->module_fields = [
            ['name' => 'conservation_goal', 'type' => 'text-area',     'label' => trans('imet-core::v2_report.InitialPlanningOptions.fields.conservation_goal')],
            ['name' => 'kea',               'type' => 'text-area',     'label' => trans('imet-core::v2_report.InitialPlanningOptions.fields.kea')],
            ['name' => 'main_threat',       'type' => 'text-area',     'label' => trans('imet-core::v2_report.InitialPlanningOptions.fields.main_threat')],
            ['name' => 'improvement',    'type' => 'text-area',     'label' => trans('imet-core::v2_report.InitialPlanningOptions.fields.improvement')],
            ['name' => 'activities',    'type' => 'text-area',     'label' => trans('imet-core::v2_report.InitialPlanningOptions.fields.activities')],
            ['name' => 'indicators',    'type' => 'text-area',     'label' => trans('imet-core::v2_report.InitialPlanningOptions.fields.indicators')],
        ];

        $this->module_info = trans('imet-core::v2_report.InitialPlanningOptions.module_info');
        $this->fieldsDefinitions = trans('imet-core::v2_report.InitialPlanningOptions.definitions');

        parent::__construct($attributes);
    }
}
