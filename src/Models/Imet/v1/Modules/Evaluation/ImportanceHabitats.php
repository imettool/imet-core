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

class ImportanceHabitats extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_importance_c14';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'C1.4';
        $this->module_title = trans('imet-core::v1_evaluation.ImportanceHabitats.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ImportanceHabitats.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3',   'label' => trans('imet-core::v1_evaluation.ImportanceHabitats.fields.EvaluationScore')],
            ['name' => 'EvaluationScore2',  'type' => 'rating-1to3',   'label' => trans('imet-core::v1_evaluation.ImportanceHabitats.fields.EvaluationScore2')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ImportanceHabitats.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v1_evaluation.ImportanceHabitats.groups.group0'),
            'group1' => trans('imet-core::v1_evaluation.ImportanceHabitats.groups.group1'),
        ];

        $this->module_subTitle = trans('imet-core::v1_evaluation.ImportanceHabitats.module_subTitle');
        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.ImportanceHabitats.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.ImportanceHabitats.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.ImportanceHabitats.ratingLegend');


        parent::__construct($attributes);

    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'Eval_ImportanceC14',
            'fields' => [
                'Aspect',  'EvaluationScore', 'EvaluationScore2', 'Comments', 'GroupAspect'
            ]
        ];
    }

    /**
     * Review data from SQLITE
     *
     * @param $record
     * @param $sqlite_connection
     */
    protected static function conversionDataReview($record, $sqlite_connection): array
    {
        return static::convertGroupLabelToKey($record, 'GroupAspect');
    }
}
