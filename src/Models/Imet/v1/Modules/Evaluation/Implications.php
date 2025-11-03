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

final class Implications extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_implications';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR11';
        $this->module_title = trans('imet-core::v1_evaluation.Implications.title');
        $this->module_fields = [
            ['name' => 'Actor',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.Implications.fields.Actor')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::v1_evaluation.Implications.fields.EvaluationScore')],
            ['name' => 'Percentage',  'type' => 'integer',   'label' => trans('imet-core::v1_evaluation.Implications.fields.Percentage')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.Implications.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v1_evaluation.Implications.groups.group0'),
            'group1' => trans('imet-core::v1_evaluation.Implications.groups.group1'),
            'group2' => trans('imet-core::v1_evaluation.Implications.groups.group2'),
            'group3' => trans('imet-core::v1_evaluation.Implications.groups.group3'),
        ];

        $this->predefined_values = [
            'field' => 'Actor',
            'values' => [
                'group0' => trans('imet-core::v1_evaluation.Implications.predefined_values.group0'),
                'group1' => trans('imet-core::v1_evaluation.Implications.predefined_values.group1'),
            ],
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.Implications.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.Implications.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.Implications.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'Eval_Implications',
            'fields' => [
                'Actor', 'EvaluationScore', 'Percentage', 'Comments', 'GroupActor',
            ],
        ];
    }

    /**
     * Review data from SQLITE
     */
    protected static function conversionDataReview(array $record, $sqlite_connection): array
    {
        return self::convertGroupLabelToKey($record, 'GroupActor');
    }
}
