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

namespace ImetCore\Models\Imet\oecm\Modules\Evaluation;

use ImetCore\Models\Imet\oecm\Modules;
use ImetCore\Models\User\Role;

class LawEnforcementImplementation extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_law_enforcement_implementation';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR8';
        $this->module_title = trans('imet-core::oecm_evaluation.LawEnforcementImplementation.title');
        $this->module_fields = [
            ['name' => 'Element',   'type' => 'text-area',          'label' => trans('imet-core::oecm_evaluation.LawEnforcementImplementation.fields.Element'), 'other' => 'rows="3"'],
            ['name' => 'Adequacy',  'type' => 'rating-0to3WithNA',  'label' => trans('imet-core::oecm_evaluation.LawEnforcementImplementation.fields.Adequacy')],
            ['name' => 'Comments',  'type' => 'text-area',               'label' => trans('imet-core::oecm_evaluation.LawEnforcementImplementation.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::oecm_evaluation.LawEnforcementImplementation.groups.group0'),
            'group1' => trans('imet-core::oecm_evaluation.LawEnforcementImplementation.groups.group1'),
        ];

        $this->predefined_values = [
            'field' => 'Element',
            'values' => [
                'group0' => trans('imet-core::oecm_evaluation.LawEnforcementImplementation.predefined_values.group0'),
                'group1' => trans('imet-core::oecm_evaluation.LawEnforcementImplementation.predefined_values.group1'),
            ],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.LawEnforcementImplementation.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.LawEnforcementImplementation.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.LawEnforcementImplementation.ratingLegend');

        parent::__construct($attributes);
    }

    public static function get_terrestrial_groups(): array
    {
        $groups = (new static)->module_groups;

        return [
            $groups['group0'],
        ];
    }

    public static function get_marine_groups(): array
    {
        $groups = (new static)->module_groups;

        return [
            $groups['group1'],
        ];
    }
}
