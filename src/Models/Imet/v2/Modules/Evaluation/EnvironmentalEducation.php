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

namespace ImetCore\Models\Imet\v2\Modules\Evaluation;

use ImetCore\Models\Imet\v2\Modules;
use ImetCore\Models\User\Role;

class EnvironmentalEducation extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_actors_relations';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'PR12';
        $this->module_title = trans('imet-core::v2_evaluation.EnvironmentalEducation.title');
        $this->module_fields = [
            ['name' => 'Activity',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.EnvironmentalEducation.fields.Activity')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::v2_evaluation.EnvironmentalEducation.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.EnvironmentalEducation.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Activity',
            'values' => trans('imet-core::v2_evaluation.EnvironmentalEducation.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.EnvironmentalEducation.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.EnvironmentalEducation.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.EnvironmentalEducation.ratingLegend');

        parent::__construct($attributes);

    }
}
