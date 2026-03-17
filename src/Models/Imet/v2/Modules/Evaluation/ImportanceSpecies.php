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

final class ImportanceSpecies extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_importance_c13';

    protected bool $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCY_ON = 'Aspect';

    protected static $DEPENDENCIES = [
        [Modules\Evaluation\InformationAvailability::class, 'Aspect'],
        [Modules\Evaluation\KeyConservationTrend::class, 'Aspect'],
        [Modules\Evaluation\ManagementActivities::class, 'Aspect'],
    ];

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'C1.2';
        $this->module_title = trans('imet-core::v2_evaluation.ImportanceSpecies.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'blade-imet-core::v2.evaluation.fields.key_element',      'label' => trans('imet-core::v2_evaluation.ImportanceSpecies.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3',   'label' => trans('imet-core::v2_evaluation.ImportanceSpecies.fields.EvaluationScore')],
            ['name' => 'SignificativeSpecies',  'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_evaluation.ImportanceSpecies.fields.SignificativeSpecies')],
            ['name' => 'IncludeInStatistics',  'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_evaluation.ImportanceSpecies.fields.IncludeInStatistics')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.ImportanceSpecies.fields.Comments')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_evaluation.ImportanceSpecies.groups.group0'),
            'group1' => trans('imet-core::v2_evaluation.ImportanceSpecies.groups.group1'),
        ];

        $this->module_subTitle = trans('imet-core::v2_evaluation.ImportanceSpecies.module_subTitle');
        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.ImportanceSpecies.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.ImportanceSpecies.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.ImportanceSpecies.ratingLegend');

        parent::__construct($attributes);

    }

    /**
     * Prefill from CTX
     */
    #[\Override]
    public static function getPredefined(?int $form_id = null): array
    {
        $predefined_values = $form_id !== null
            ? [
                'group0' => Modules\Context\AnimalSpecies::getModule($form_id)
                    ->filter()
                    ->pluck('species')
                    ->toArray(),
                'group1' => Modules\Context\VegetalSpecies::getModule($form_id)
                    ->filter()
                    ->pluck('Species')
                    ->toArray(),
            ]
            : [];

        return [
            'field' => self::$DEPENDENCY_ON,
            'values' => $predefined_values,
        ];
    }

    /**
     * Override
     */
    #[\Override]
    public function isEmptyRecord($record, $foreign_key = null): bool
    {
        if ($record['EvaluationScore'] !== null
            || $record['SignificativeSpecies'] !== null
            || $record['IncludeInStatistics'] !== null
            || $record['Comments'] !== null) {
            return false;
        }

        return true;
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
