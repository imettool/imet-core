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

namespace ImetCore\Models\Imet\ImetV2\Modules\Evaluation;

use ImetCore\Models\Imet\ImetV2\Modules;
use ImetCore\Models\User\Role;

final class LifeQualityImpact extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_life_quality_impact';

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::v2.evaluation.edit.modules.life_quality_impact';
    public const string BODY_SHOW_BLADE_VIEW = 'imet-core::v2.evaluation.show.modules.life_quality_impact';

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'O/C3';
        $this->module_title = trans('imet-core::v2_evaluation.LifeQualityImpact.title');
        $this->module_fields = [
            ['name' => 'Element',           'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.LifeQualityImpact.fields.Element')],
            ['name' => 'EvaluationScore',   'type' => 'rating-Minus3to3WithNA',   'label' => trans('imet-core::v2_evaluation.LifeQualityImpact.fields.EvaluationScore')],
            ['name' => 'Comments',          'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.LifeQualityImpact.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_evaluation.LifeQualityImpact.groups.group0'),
            'group1' => trans('imet-core::v2_evaluation.LifeQualityImpact.groups.group1'),
        ];

        $this->predefined_values = [
            'field' => 'Element',
            'values' => [
                'group0' => trans('imet-core::v2_evaluation.LifeQualityImpact.predefined_values.group0'),
                'group1' => trans('imet-core::v2_evaluation.LifeQualityImpact.predefined_values.group1'),
            ],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.LifeQualityImpact.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.LifeQualityImpact.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.LifeQualityImpact.ratingLegend');

        parent::__construct($attributes);

    }
}
