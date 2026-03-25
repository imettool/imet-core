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
final class SupportsAndConstraintsIntegration extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_supports_constraints_integration';

    public bool $fixed_rows = true;

    public $titles = [];

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public const string BODY_SHOW_BLADE_VIEW = 'imet-core::oecm.evaluation.show.modules.supports_and_constraints_integration';

    protected static $DEPENDENCY_ON = 'Stakeholder';

    protected static $DEPENDENCIES = [
        [Objectives::class, 'Stakeholder'],
        [InformationAvailability::class, 'Stakeholder'],
    ];

    public static array $extra_raw_fields = ['Ranking' => '__score'];

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'C2.2';
        $this->module_title = trans('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.title');
        $this->module_fields = [
            ['name' => 'Stakeholder',       'type' => 'blade-imet-core::oecm.evaluation.fields.support_integration_stakeholder_with_ranking',   'label' => trans('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.fields.Stakeholder')],
            ['name' => 'Integration',       'type' => 'rating-0to3',   'label' => trans('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.fields.Integration')],
            ['name' => 'IncludeInStatistics',   'type' => 'checkbox-boolean',   'label' => trans('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.fields.IncludeInStatistics')],
            ['name' => 'Comments',              'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.fields.Comments')],
        ];

        $this->module_groups = trans('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.groups');
        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.ratingLegend');

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

    #[\Override]
    protected static function arrange_records(?array $predefined_values, array $records, array $empty_record): array
    {
        $records = parent::arrange_records($predefined_values, $records, $empty_record);
        $form_id = $empty_record['FormID'];

        $weight = Modules\Context\Stakeholders::calculateWeights($form_id);
        $ranking = collect(SupportsAndConstraints::calculateRanking($form_id))
            ->pluck('ConstraintLevel', 'Stakeholder')
            ->toArray();

        foreach ($records as $idx => $record) {
            $records[$idx]['__weight'] = $weight[$record['Stakeholder']] ?? null;
            $records[$idx]['__score'] = $ranking[$record['Stakeholder']] !== null ? $ranking[$record['Stakeholder']] * 100 / 3 : null;
        }

        return collect($records)
            ->sortBy('__score')
            ->values()
            ->all();
    }

    /**
     * Provide the list of prioritized key elements
     */
    public static function getPrioritizedElements(?int $form_id): array
    {
        return collect(self::getModuleRecords($form_id)['records'])
            ->filter(fn (array $item) => $item['IncludeInStatistics'])
            ->pluck('Stakeholder')
            ->toArray();
    }

    #[\Override]
    protected static function getRecordsToBeDropped($records, $form_id, $dependency_on): array
    {
        // Get list of values (of reference field) from DB and from updated records
        $existing_values = self::getModule($form_id)
            ->where('IncludeInStatistics', true)
            ->pluck($dependency_on)
            ->toArray();
        $updated_values = collect($records)
            ->where('IncludeInStatistics', true)
            ->pluck($dependency_on)
            ->toArray();

        // Make diff to find out what to drop
        $to_be_dropped = array_diff($existing_values, $updated_values);

        return array_values($to_be_dropped);
    }
}
