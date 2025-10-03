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

class ProtectionActivities extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_protection_activities';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = []) {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR8';
        $this->module_title = trans('imet-core::v1_evaluation.ProtectionActivities.title');
        $this->module_fields = [
            ['name' => 'Activity',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ProtectionActivities.fields.Activity')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::v1_evaluation.ProtectionActivities.fields.EvaluationScore')],
            ['name' => 'Percentage',  'type' => 'integer',   'label' => trans('imet-core::v1_evaluation.ProtectionActivities.fields.Percentage')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.ProtectionActivities.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v1_evaluation.ProtectionActivities.groups.group0'),
            'group1' => trans('imet-core::v1_evaluation.ProtectionActivities.groups.group1'),
            'group2' => trans('imet-core::v1_evaluation.ProtectionActivities.groups.group2'),
            'group3' => trans('imet-core::v1_evaluation.ProtectionActivities.groups.group3'),
            'group4' => trans('imet-core::v1_evaluation.ProtectionActivities.groups.group4'),
            'group5' => trans('imet-core::v1_evaluation.ProtectionActivities.groups.group5'),
            'group6' => trans('imet-core::v1_evaluation.ProtectionActivities.groups.group6'),
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.ProtectionActivities.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.ProtectionActivities.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.ProtectionActivities.ratingLegend');

        parent::__construct($attributes);

    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'Eval_ProtectionActivities',
            'fields' => [
                'Activity', 'EvaluationScore', 'Percentage', 'Comments', 'GroupActivity'
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
        return static::convertGroupLabelToKey($record, 'GroupActivity');
    }
}
