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
use ModularForms\Enums\ModuleTypes;

final class ImportanceClassification extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_importance_c12';

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = [])
    {

        $this->module_type = ModuleTypes::TABLE;
        $this->module_code = 'C1.1';
        $this->module_title = trans('imet-core::v2_evaluation.ImportanceClassification.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.ImportanceClassification.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3',   'label' => trans('imet-core::v2_evaluation.ImportanceClassification.fields.EvaluationScore')],
            ['name' => 'SignificativeClassification',  'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_evaluation.ImportanceClassification.fields.SignificativeClassification')],
            ['name' => 'IncludeInStatistics',  'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_evaluation.ImportanceClassification.fields.IncludeInStatistics')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.ImportanceClassification.fields.Comments')],
        ];

        $this->module_subTitle = trans('imet-core::v2_evaluation.ImportanceClassification.module_subTitle');
        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.ImportanceClassification.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.ImportanceClassification.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.ImportanceClassification.ratingLegend');

        parent::__construct($attributes);

    }
}
