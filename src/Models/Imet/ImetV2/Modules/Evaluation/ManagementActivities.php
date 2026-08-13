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

namespace ImetCore\Models\Imet\ImetV2\Modules\Evaluation;

use Illuminate\Database\Eloquent\Collection;
use ImetCore\Models\Imet\ImetV2\Modules;
use ImetCore\Models\Species;
use ImetCore\Models\User\Role;
use ModularForms\Enums\ModuleTypes;

final class ManagementActivities extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_management_activities';

    public bool $fixed_rows = true;

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::v2.evaluation.edit.modules.management_activities';

    public const string BODY_SHOW_BLADE_VIEW = 'imet-core::v2.evaluation.show.modules.management_activities';

    protected static $DEPENDENCY_ON = 'Activity';

    public function __construct(array $attributes = [])
    {

        $this->module_type = ModuleTypes::GROUP_TABLE;
        $this->module_code = 'PR7';
        $this->module_title = trans('imet-core::v2_evaluation.ManagementActivities.title');
        $this->module_fields = [
            ['name' => 'Activity',  'type' => 'custom::v2-key-element',   'label' => trans('imet-core::v2_evaluation.ManagementActivities.fields.Activity')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3WithNA',   'label' => trans('imet-core::v2_evaluation.ManagementActivities.fields.EvaluationScore')],
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
                    'group0' => ImportanceSpecies::getModule($form_id)
                        ->filter(fn ($item): bool => $item['IncludeInStatistics'] && $item['group_key'] === 'group0')
                        ->pluck('Aspect')
                        ->filter()
                        ->toArray(),
                    'group1' => ImportanceSpecies::getModule($form_id)
                        ->filter(fn ($item): bool => $item['IncludeInStatistics'] && $item['group_key'] === 'group1')
                        ->pluck('Aspect')
                        ->filter()
                        ->toArray(),
                    'group2' => ImportanceHabitats::getModule($form_id)
                        ->filter(fn ($item): mixed => $item['IncludeInStatistics'])
                        ->pluck('Aspect')
                        ->filter()
                        ->toArray(),
                    'group4' => Menaces::getModule($form_id)
                        ->filter(fn ($item): mixed => $item['IncludeInStatistics'])
                        ->pluck('Aspect')
                        ->filter()
                        ->toArray(),
                    'group5' => SupportsAndConstraints::getModule($form_id)
                        ->filter(fn ($item): mixed => $item['IncludeInStatistics'])
                        ->pluck('Aspect')
                        ->filter()
                        ->toArray(),
                ]
                : [],
        ];
    }

    /**
     * Override: for group0 (animal species) add a virtual field with the scientific name and vernacular names to be
     * used as label in the UI
     */
    #[\Override]
    public static function getModuleRecords(?int $form_id, ?Collection $collection = null): array
    {
        $records = parent::getModuleRecords($form_id, $collection);

        foreach ($records['records'] as $idx => $record) {
            if ($record[self::$group_key_field] === 'group0') {
                $records['records'][$idx]['__key_element_label'] = Species::getPreview($records['records'][$idx]['Activity']);
            }
        }

        return $records;
    }

    #[\Override]
    public static function upgradeModule($record, $imet_version = null): array
    {
        // ####  v2.7 -> v2.8 (marine pas)  ####
        if (blank($imet_version) || $imet_version < 'v2.7.6b') {
            // group3 merged into group2
            $record = self::replaceGroup($record, 'group_key', 'group3', 'group2');
        }

        // ####  v3.7.3 -> v3.7.4 ####
        $record = self::dropField($record, 'InManagementPlan');

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
