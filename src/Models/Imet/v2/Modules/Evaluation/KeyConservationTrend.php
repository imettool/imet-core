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

namespace ImetCore\Models\Imet\v2\Modules\Evaluation;

use ImetCore\Models\Imet\v2\Modules;
use ImetCore\Models\User\Role;

class KeyConservationTrend extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_key_conservation_trends';

    protected bool $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCY_ON = 'Element';

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'O/C2';
        $this->module_title = trans('imet-core::v2_evaluation.KeyConservationTrend.title');
        $this->module_fields = [
            ['name' => 'Element',   'type' => 'blade-imet-core::v2.evaluation.fields.key_element',           'label' => trans('imet-core::v2_evaluation.KeyConservationTrend.fields.Element')],
            ['name' => 'Condition', 'type' => 'rating-Minus3to3WithNA',    'label' => trans('imet-core::v2_evaluation.KeyConservationTrend.fields.Condition')],
            ['name' => 'Trend',     'type' => 'rating-Minus3to3WithNA',    'label' => trans('imet-core::v2_evaluation.KeyConservationTrend.fields.Trend')],
            ['name' => 'Reliability',  'type' => 'dropdown-ImetV2_SpeciesReliability',   'label' => trans('imet-core::v2_evaluation.KeyConservationTrend.fields.Reliability'), 'class' => 'width100px'],
            ['name' => 'Comments',  'type' => 'text-area',           'label' => trans('imet-core::v2_evaluation.KeyConservationTrend.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_evaluation.KeyConservationTrend.groups.group0'),
            'group1' => trans('imet-core::v2_evaluation.KeyConservationTrend.groups.group1'),
            'group2' => trans('imet-core::v2_evaluation.KeyConservationTrend.groups.group2'),
            'group3' => trans('imet-core::v2_evaluation.KeyConservationTrend.groups.group3'),
            'group4' => trans('imet-core::v2_evaluation.KeyConservationTrend.groups.group4'),
            'group5' => trans('imet-core::v2_evaluation.KeyConservationTrend.groups.group5'),
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.KeyConservationTrend.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.KeyConservationTrend.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.KeyConservationTrend.ratingLegend');

        parent::__construct($attributes);

    }

    /**
     * Prefill from CTX
     */
    #[\Override]
    protected static function getPredefined($form_id = null): ?array
    {
        return [
            'field' => static::$DEPENDENCY_ON,
            'values' => $form_id !== null
                ? [
                    'group0' => Modules\Evaluation\ImportanceSpecies::getModule($form_id)->filter(function ($item): bool {
                        return $item['IncludeInStatistics'] && $item['group_key'] === 'group0';
                    })->pluck('Aspect')->toArray(),
                    'group1' => Modules\Evaluation\ImportanceSpecies::getModule($form_id)->filter(function ($item): bool {
                        return $item['IncludeInStatistics'] && $item['group_key'] === 'group1';
                    })->pluck('Aspect')->toArray(),
                    'group2' => Modules\Evaluation\ImportanceHabitats::getModule($form_id)->filter(function ($item) {
                        return $item['IncludeInStatistics'];
                    })->pluck('Aspect')->toArray(),
                    'group3' => Modules\Evaluation\Menaces::getModule($form_id)->filter(function ($item) {
                        return $item['IncludeInStatistics'];
                    })->pluck('Aspect')->toArray(),
                    'group4' => Modules\Evaluation\ImportanceClimateChange::getModule($form_id)->filter(function ($item) {
                        return $item['IncludeInStatistics'];
                    })->pluck('Aspect')->toArray(),
                    'group5' => Modules\Evaluation\ImportanceEcosystemServices::getModule($form_id)->filter(function ($item) {
                        return $item['IncludeInStatistics'];
                    })->pluck('Aspect')->toArray(),
                ]
                : [],
        ];
    }

    /**
     * Override
     */
    #[\Override]
    public function isEmptyRecord($record, $foreign_key = null): bool
    {
        if ($record['Condition'] !== null
            || $record['Trend'] !== null
            || $record['Reliability'] !== null
            || $record['Comments'] !== null) {
            return false;
        }

        return true;
    }
}
