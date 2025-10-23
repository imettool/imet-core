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

namespace ImetCore\Models\Imet\oecm\Modules\Evaluation;

use ImetCore\Models\Imet\oecm\Modules;
use ImetCore\Models\User\Role;

final class StakeholderCooperation extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_stakeholder_cooperation';

    protected bool $fixed_rows = true;

    public $titles = [];

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    protected static $DEPENDENCY_ON = 'Element';

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR9';
        $this->module_title = trans('imet-core::oecm_evaluation.StakeholderCooperation.title');
        $this->module_fields = [
            ['name' => 'Element',           'type' => 'disabled',           'label' => trans('imet-core::oecm_evaluation.StakeholderCooperation.fields.Element'), 'other' => 'rows="3"'],
            ['name' => 'Weight',            'type' => 'disabled',           'label' => trans('imet-core::oecm_evaluation.StakeholderCooperation.fields.Weight')],
            ['name' => 'Cooperation',       'type' => 'rating-0to3WithNA',  'label' => trans('imet-core::oecm_evaluation.StakeholderCooperation.fields.Cooperation')],
            ['name' => 'Comments',          'type' => 'text-area',          'label' => trans('imet-core::oecm_evaluation.StakeholderCooperation.fields.Comments')],
        ];

        $this->module_groups = trans('imet-core::oecm_evaluation.StakeholderCooperation.groups');

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.StakeholderCooperation.module_info_EvaluationQuestion');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.StakeholderCooperation.ratingLegend');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.StakeholderCooperation.module_info_Rating');

        parent::__construct($attributes);
    }

    #[\Override]
    public static function getPredefined(?int $form_id = null): array
    {
        $predefined_values = $form_id !== null
            ? [
                'group0' => Modules\Context\Stakeholders::getStakeholders($form_id, Modules\Context\Stakeholders::ONLY_DIRECT),
                'group1' => Modules\Context\Stakeholders::getStakeholders($form_id, Modules\Context\Stakeholders::ONLY_INDIRECT),
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
        $weight = Modules\Context\Stakeholders::calculateWeights($form_id);

        foreach ($records as $idx => $record) {
            $records[$idx]['Weight'] = $weight[$record['Element']] ?? null;
        }

        return collect($records)
            ->sortByDesc('Weight')
            ->values()
            ->all();
    }

    /**
     * Override
     */
    #[\Override]
    public function isEmptyRecord($record, $foreign_key = null): bool
    {
        return $record['Element'] === null;
    }
}
