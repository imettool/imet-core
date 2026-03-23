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

/**
 * @property string[] $titles
 */
final class SupportsAndConstraints extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_supports_constraints';

    public bool $fixed_rows = true;

    public $titles = [];

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCY_ON = 'Stakeholder';

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'C2.1';
        $this->module_title = trans('imet-core::oecm_evaluation.SupportsAndConstraints.title');
        $this->module_fields = [
            ['name' => 'Stakeholder',       'type' => 'disabled',   'label' => trans('imet-core::oecm_evaluation.SupportsAndConstraints.fields.Stakeholder')],
            ['name' => 'Weight',            'type' => 'disabled',   'label' => trans('imet-core::oecm_evaluation.SupportsAndConstraints.fields.Weight')],
            ['name' => 'ConstraintLevel',   'type' => 'rating-Minus3to3',   'label' => trans('imet-core::oecm_evaluation.SupportsAndConstraints.fields.ConstraintLevel')],
            ['name' => 'Comments',           'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.SupportsAndConstraints.fields.Comments')],
        ];

        $this->module_groups = trans('imet-core::oecm_evaluation.SupportsAndConstraints.groups');
        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.SupportsAndConstraints.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.SupportsAndConstraints.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.SupportsAndConstraints.ratingLegend');

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
            $records[$idx]['Weight'] = $weight[$record['Stakeholder']] ?? null;
        }

        return collect($records)
            ->sortByDesc('Weight')
            ->values()
            ->all();
    }

    public static function calculateRanking(?int $form_id): array
    {
        $records = self::getModuleRecords($form_id)['records'];

        return collect($records)
            ->map(function (array $item): array {
                $item['__score'] = $item['Weight'] !== null && $item['ConstraintLevel'] !== null
                    ? $item['ConstraintLevel'] * $item['Weight']
                    : null;

                return $item;
            })
            ->all();
    }
}
