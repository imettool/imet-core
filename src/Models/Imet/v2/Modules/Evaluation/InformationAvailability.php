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

use Illuminate\Database\Eloquent\Collection;
use ImetCore\Models\Imet\v2\Modules;
use ImetCore\Models\Species;
use ImetCore\Models\User\Role;

final class InformationAvailability extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_information_availability';

    protected bool $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    protected static $DEPENDENCY_ON = 'Element';

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'I1';
        $this->module_title = trans('imet-core::v2_evaluation.InformationAvailability.title');
        $this->module_fields = [
            ['name' => 'Element',  'type' => 'blade-imet-core::v2.evaluation.fields.key_element',   'label' => trans('imet-core::v2_evaluation.InformationAvailability.fields.Element')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3',   'label' => trans('imet-core::v2_evaluation.InformationAvailability.fields.EvaluationScore')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.InformationAvailability.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_evaluation.InformationAvailability.groups.group0'),
            'group1' => trans('imet-core::v2_evaluation.InformationAvailability.groups.group1'),
            'group2' => trans('imet-core::v2_evaluation.InformationAvailability.groups.group2'),
            'group3' => trans('imet-core::v2_evaluation.InformationAvailability.groups.group3'),
            'group4' => trans('imet-core::v2_evaluation.InformationAvailability.groups.group4'),
            'group5' => trans('imet-core::v2_evaluation.InformationAvailability.groups.group5'),
            'group6' => trans('imet-core::v2_evaluation.InformationAvailability.groups.group6'),
            'group7' => trans('imet-core::v2_evaluation.InformationAvailability.groups.group7'),
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.InformationAvailability.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.InformationAvailability.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.InformationAvailability.ratingLegend');

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
                    'group3' => Modules\Evaluation\Menaces::getModule($form_id)
                        ->filter(fn ($item): mixed => $item['IncludeInStatistics'])
                        ->pluck('Aspect')
                        ->filter()
                        ->toArray(),
                    'group4' => Modules\Evaluation\ImportanceClimateChange::getModule($form_id)
                        ->filter(fn ($item): mixed => $item['IncludeInStatistics'])
                        ->pluck('Aspect')
                        ->filter()
                        ->toArray(),
                    'group5' => Modules\Evaluation\ImportanceEcosystemServices::getModule($form_id)
                        ->filter(fn ($item): mixed => $item['IncludeInStatistics'])
                        ->pluck('Aspect')
                        ->filter()
                        ->toArray(),
                    'group6' => Modules\Evaluation\ImportanceClassification::getModule($form_id)
                        ->filter(fn ($item): mixed => $item['IncludeInStatistics'])
                        ->pluck('Aspect')
                        ->filter()
                        ->toArray(),
                    'group7' => Modules\Evaluation\SupportsAndConstraints::getModule($form_id)
                        ->filter(fn ($item): mixed => $item['IncludeInStatistics'])
                        ->filter()
                        ->pluck('Aspect')
                        ->toArray()
                    ]
                : [],
        ];
    }

    /**
     * Override: for group0 (animal species) add a virtual field with the scientific name and vernacular names to be
     * used as label in the UI
     */
    public static function getModuleRecords(?int $form_id, ?Collection $collection = null): array
    {
        $records = parent::getModuleRecords($form_id, $collection);

        foreach ($records['records'] as $idx => $record) {
            if($record[self::$group_key_field] === 'group0') {
                $records['records'][$idx]['__key_element_label'] = Species::getPreview($records['records'][$idx]['Element']);
            }
        }
        return $records;
    }

    /**
     * Override
     */
    #[\Override]
    public function isEmptyRecord($record, $foreign_key = null): bool
    {
        if ($record['EvaluationScore'] !== null
            || $record['Comments'] !== null) {
            return false;
        }

        return true;
    }

    #[\Override]
    protected function customValue(array $record, array $field): string|array|null
    {
        $value = $record[$field['name']] ?? null;
        if (Species::isTaxonomy($value)) {
            $taxonomy = Species::parseTaxonomy($value);

            return $taxonomy['genus'].' '.$taxonomy['species'];
        }

        return $value;
    }
}
