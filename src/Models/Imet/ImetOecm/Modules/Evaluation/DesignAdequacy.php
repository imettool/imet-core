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

final class DesignAdequacy extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_design_adequacy';

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = [])
    {

        $this->module_type = ModuleTypes::TABLE;
        $this->module_code = 'P2';
        $this->module_title = trans('imet-core::oecm_evaluation.DesignAdequacy.title');
        $this->module_fields = [
            ['name' => 'Values',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.DesignAdequacy.fields.Values')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::oecm_evaluation.DesignAdequacy.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.DesignAdequacy.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Values',
            'values' => trans('imet-core::oecm_evaluation.DesignAdequacy.predefined_values'),
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.DesignAdequacy.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.DesignAdequacy.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.DesignAdequacy.ratingLegend');

        parent::__construct($attributes);
    }
}
