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

namespace ImetCore\Models\Imet\v1\Modules\Evaluation;

use ImetCore\Models\Imet\v1\Modules;
use ImetCore\Models\User\Role;

class SupportsAndConstraints extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_supports_and_constaints';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'C2';
        $this->module_title = trans('imet-core::v1_evaluation.SupportsAndConstraints.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.SupportsAndConstraints.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'rating-Minus3to3WithNA',   'label' => trans('imet-core::v1_evaluation.SupportsAndConstraints.fields.EvaluationScore')],
            ['name' => 'EvaluationScore2',  'type' => 'rating-1to3',   'label' => trans('imet-core::v1_evaluation.SupportsAndConstraints.fields.EvaluationScore2')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.SupportsAndConstraints.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Aspect',
            'values' => trans('imet-core::v1_evaluation.SupportsAndConstraints.predefined_values')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.SupportsAndConstraints.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.SupportsAndConstraints.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.SupportsAndConstraints.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'Eval_SupportsAndConstaints',
            'fields' => [
                'Aspect',  'EvaluationScore', 'EvaluationScore2', 'Comments'
            ]
        ];
    }
}
