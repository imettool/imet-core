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
use ImetCore\Models\Species;
use ImetCore\Models\User\Role;

final class ManagementActivities extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_management_activities';

    protected bool $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    protected static $DEPENDENCY_ON = 'Activity';

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'PR7';
        $this->module_title = trans('imet-core::v2_evaluation.ManagementActivities.title');
        $this->module_fields = [
            ['name' => 'Activity',  'type' => 'blade-imet-core::v2.evaluation.fields.key_element',   'label' => trans('imet-core::v2_evaluation.ManagementActivities.fields.Activity')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::v2_evaluation.ManagementActivities.fields.EvaluationScore')],
            ['name' => 'InManagementPlan',  'type' => 'checkbox-boolean_numeric',   'label' => trans('imet-core::v2_evaluation.ManagementActivities.fields.InManagementPlan')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.ManagementActivities.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_evaluation.ManagementActivities.groups.group0'),
            'group1' => trans('imet-core::v2_evaluation.ManagementActivities.groups.group1'),
            'group2' => trans('imet-core::v2_evaluation.ManagementActivities.groups.group2'),
            'group4' => trans('imet-core::v2_evaluation.ManagementActivities.groups.group4'),
            'group5' => trans('imet-core::v2_evaluation.ManagementActivities.groups.group5'),
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.ManagementActivities.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.ManagementActivities.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.ManagementActivities.ratingLegend');

        parent::__construct($attributes);

    }

    /**
     * Prefill from CTX
     */
    #[\Override]
    public static function getPredefined(?int $form_id = null): array
    {
        return [
            'field' => self::$DEPENDENCY_ON,
            'values' => $form_id !== null
                ? [
                    'group0' => Modules\Evaluation\ImportanceSpecies::getModule($form_id)
                        ->filter(fn ($item): bool => $item['IncludeInStatistics'] && $item['group_key'] === 'group0')
                        ->pluck('Aspect')
                        ->filter()
                        ->toArray(),
                    'group1' => Modules\Evaluation\ImportanceSpecies::getModule($form_id)
                        ->filter(fn ($item): bool => $item['IncludeInStatistics'] && $item['group_key'] === 'group1')
                        ->pluck('Aspect')
                        ->filter()
                        ->toArray(),
                    'group2' => Modules\Evaluation\ImportanceHabitats::getModule($form_id)
                        ->filter(fn ($item): mixed => $item['IncludeInStatistics'])
                        ->pluck('Aspect')
                        ->filter()
                        ->toArray(),
                    'group4' => Modules\Evaluation\Menaces::getModule($form_id)
                        ->filter(fn ($item): mixed => $item['IncludeInStatistics'])
                        ->pluck('Aspect')
                        ->filter()
                        ->toArray(),
                    'group5' => Modules\Evaluation\SupportsAndConstraints::getModule($form_id)
                        ->filter(fn ($item): mixed => $item['IncludeInStatistics'])
                        ->pluck('Aspect')
                        ->filter()
                        ->toArray()
                ]
                : [],
        ];
    }

    public static function upgradeModule($record, $imet_version = null): array
    {
        // ####  v2.7 -> v2.8 (marine pas)  ####
        if (blank($imet_version) || $imet_version < 'v2.7.6b') {
            // group3 merged into group2
            return self::replaceGroup($record, 'group_key', 'group3', 'group2');
        }

        return $record;
    }

    #[\Override]
    protected function customValue(array $record, array $field): string|array|null
    {
        $value = $record[$field['name']] ?? null;
        if ($value && Species::isTaxonomy($value)) {
            $taxonomy = Species::parseTaxonomy($value);

            return $taxonomy['genus'].' '.$taxonomy['species'];
        }

        return $value;
    }
}
