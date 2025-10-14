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

class InformationAvailability extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_information_availability';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'I1';
        $this->module_title = trans('imet-core::v1_evaluation.InformationAvailability.title');
        $this->module_fields = [
            ['name' => 'Element',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.InformationAvailability.fields.Element')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3',   'label' => trans('imet-core::v1_evaluation.InformationAvailability.fields.EvaluationScore')],
            ['name' => 'PercentageLevel',  'type' => 'integer',   'label' => trans('imet-core::v1_evaluation.InformationAvailability.fields.PercentageLevel')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v1_evaluation.InformationAvailability.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v1_evaluation.InformationAvailability.groups.group0'),
            'group1' => trans('imet-core::v1_evaluation.InformationAvailability.groups.group1'),
            'group2' => trans('imet-core::v1_evaluation.InformationAvailability.groups.group2'),
            'group3' => trans('imet-core::v1_evaluation.InformationAvailability.groups.group3'),
            'group4' => trans('imet-core::v1_evaluation.InformationAvailability.groups.group4'),
            'group5' => trans('imet-core::v1_evaluation.InformationAvailability.groups.group5'),
            'group6' => trans('imet-core::v1_evaluation.InformationAvailability.groups.group6'),
            'group7' => trans('imet-core::v1_evaluation.InformationAvailability.groups.group7'),
            'group8' => trans('imet-core::v1_evaluation.InformationAvailability.groups.group8'),
            'group9' => trans('imet-core::v1_evaluation.InformationAvailability.groups.group9'),
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v1_evaluation.InformationAvailability.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v1_evaluation.InformationAvailability.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v1_evaluation.InformationAvailability.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'Eval_InformationAvailability',
            'fields' => [
                'Element',  'EvaluationScore', 'PercentageLevel', 'Comments', 'GroupElement',
            ],
        ];
    }

    /**
     * Review data from SQLITE
     */
    protected static function conversionDataReview(array $record, $sqlite_connection): array
    {
        return static::convertGroupLabelToKey($record, 'GroupElement');
    }
}
