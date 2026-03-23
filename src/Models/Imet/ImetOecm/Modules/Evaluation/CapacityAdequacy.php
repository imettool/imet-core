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

final class CapacityAdequacy extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_capacity_adequacy';

    public bool $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    protected static $DEPENDENCY_ON = 'Member';

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'I2';
        $this->module_title = trans('imet-core::oecm_evaluation.CapacityAdequacy.title');
        $this->module_fields = [
            ['name' => 'Member',        'type' => 'disabled',                   'label' => trans('imet-core::oecm_evaluation.CapacityAdequacy.fields.Member')],
            ['name' => 'Weight',        'type' => 'hidden',                   'label' => trans('imet-core::oecm_evaluation.CapacityAdequacy.fields.Weight')],
            ['name' => 'Adequacy',      'type' => 'rating-0to3',     'label' => trans('imet-core::oecm_evaluation.CapacityAdequacy.fields.Adequacy')],
            ['name' => 'Comments',      'type' => 'text-area',                  'label' => trans('imet-core::oecm_evaluation.CapacityAdequacy.fields.Comments')],
        ];

        $this->module_groups = trans('imet-core::oecm_evaluation.CapacityAdequacy.groups');

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.CapacityAdequacy.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.CapacityAdequacy.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.CapacityAdequacy.ratingLegend');

        parent::__construct($attributes);
    }

    #[\Override]
    public static function getPredefined(?int $form_id = null): array
    {
        $predefined_values = $form_id !== null
            ? [
                'group0' => Modules\Context\ManagementStaff::getModule($form_id)->pluck('Function')->toArray(),
                'group1' => Modules\Context\Stakeholders::getStakeholders($form_id),
            ]
            : [];

        return [
            'field' => self::$DEPENDENCY_ON,
            'values' => $predefined_values,
        ];
    }

    protected static function arrange_records(?array $predefined_values, array $records, array $empty_record): array
    {
        $form_id = $empty_record['FormID'];

        $records = parent::arrange_records($predefined_values, $records, $empty_record);

        $weighted_staff = Modules\Context\ManagementStaff::calculateWeights($form_id);
        $weighted_stakeholder = Modules\Context\Stakeholders::calculateWeights($form_id);

        foreach ($records as $idx => $module_record) {
            if ($module_record['group_key'] === 'group0') {
                $records[$idx]['Weight'] = $weighted_staff[$module_record['Member']] ?? null;
            } elseif ($module_record['group_key'] === 'group1') {
                $records[$idx]['Weight'] = $weighted_stakeholder[$module_record['Member']] ?? null;
            }
        }

        return $records;
    }
}
