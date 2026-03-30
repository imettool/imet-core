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

namespace ImetCore\Models\Imet\ImetV1\Modules\Evaluation;

use ImetCore\Models\Imet\ImetV1\Modules;
use ImetCore\Models\User\Role;
use ModularForms\Enums\ModuleTypes;

final class LocalCommunitiesImpact extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_local_communities_impact';

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = [])
    {

        $this->module_type = ModuleTypes::TABLE;
        $this->module_code = 'E/I4';
        $this->module_title = trans('imet-core::v1_evaluation.LocalCommunitiesImpact.title');
        $this->module_fields = [
            ['name' => 'Impact',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.LocalCommunitiesImpact.fields.Impact')],
            ['name' => 'EvaluationScore',  'type' => 'rating-Minus3to3WithNA',   'label' => trans('imet-core::v1_evaluation.LocalCommunitiesImpact.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.LocalCommunitiesImpact.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Impact',
            'values' => trans('imet-core::v1_evaluation.LocalCommunitiesImpact.predefined_values'),
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.LocalCommunitiesImpact.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.LocalCommunitiesImpact.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.LocalCommunitiesImpact.ratingLegend');

        parent::__construct($attributes);

    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'Eval_LocalCommunitiesImpact',
            'fields' => [
                'Impact', 'EvaluationScore', 'Comments',
            ],
        ];
    }
}
