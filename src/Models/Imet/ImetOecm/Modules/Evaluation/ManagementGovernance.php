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

namespace ImetCore\Models\Imet\ImetOecm\Modules\Evaluation;

use ImetCore\Models\Imet\ImetOecm\Modules;
use ImetCore\Models\User\Role;

final class ManagementGovernance extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_management_governance';

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'O/P2';
        $this->module_title = trans('imet-core::oecm_evaluation.ManagementGovernance.title');
        $this->module_fields = [
            ['name' => 'Patrol',            'type' => 'rating-0to3',   'label' => trans('imet-core::oecm_evaluation.ManagementGovernance.fields.Patrol')],
            ['name' => 'Comments',          'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.ManagementGovernance.fields.Comments')],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.ManagementGovernance.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.ManagementGovernance.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.ManagementGovernance.ratingLegend');

        parent::__construct($attributes);

    }
}
