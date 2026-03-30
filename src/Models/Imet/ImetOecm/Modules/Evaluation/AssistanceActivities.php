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
use ModularForms\Enums\ModuleTypes;

final class AssistanceActivities extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_assistance_activities';

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = [])
    {

        $this->module_type = ModuleTypes::GROUP_TABLE;
        $this->module_code = 'PR10';
        $this->module_title = trans('imet-core::oecm_evaluation.AssistanceActivities.title');
        $this->module_fields = [
            ['name' => 'Activity',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.AssistanceActivities.fields.Activity')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::oecm_evaluation.AssistanceActivities.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.AssistanceActivities.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::oecm_evaluation.AssistanceActivities.groups.group0'),
            'group1' => trans('imet-core::oecm_evaluation.AssistanceActivities.groups.group1'),
        ];

        $this->predefined_values = [
            'field' => 'Activity',
            'values' => [
                'group0' => trans('imet-core::oecm_evaluation.AssistanceActivities.predefined_values.group0'),
                'group1' => trans('imet-core::oecm_evaluation.AssistanceActivities.predefined_values.group1'),
            ],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.AssistanceActivities.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.AssistanceActivities.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.AssistanceActivities.ratingLegend');

        parent::__construct($attributes);
    }

    public static function get_terrestrial_predefined(): array
    {
        $predefined = (new self)->predefined_values['values'];

        return [
            $predefined['group0'][17],
        ];
    }

    public static function get_marine_predefined(): array
    {
        $predefined = (new self)->predefined_values['values'];

        return [
            $predefined['group0'][18],
            $predefined['group0'][19],
            $predefined['group0'][20],
        ];
    }
}
