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

class Designation extends Modules\Component\ImetModule_Eval
{
    protected $table = 'designation';

    protected bool $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCY_ON = 'Aspect';

    protected static $DEPENDENCIES = [
        [Objectives::class, 'Aspect'],
        [Modules\Evaluation\InformationAvailability::class, 'Aspect'],
    ];

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'TABLE';
        $this->module_code = 'C1';
        $this->module_title = trans('imet-core::oecm_evaluation.Designation.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'disabled',   'label' => trans('imet-core::oecm_evaluation.Designation.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3',   'label' => trans('imet-core::oecm_evaluation.Designation.fields.EvaluationScore')],
            ['name' => 'SignificativeClassification',  'type' => 'checkbox-boolean',   'label' => trans('imet-core::oecm_evaluation.Designation.fields.SignificativeClassification')],
            ['name' => 'IncludeInStatistics',   'type' => 'checkbox-boolean',   'label' => trans('imet-core::oecm_evaluation.Designation.fields.IncludeInStatistics')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.Designation.fields.Comments')],
        ];

        $this->module_subTitle = trans('imet-core::oecm_evaluation.Designation.module_subTitle');
        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.Designation.module_info_EvaluationQuestion');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.Designation.ratingLegend');

        parent::__construct($attributes);
    }

    #[\Override]
    protected static function getPredefined($form_id = null): ?array
    {
        return [
            'field' => static::$DEPENDENCY_ON,
            'values' => $form_id !== null
                ? array_filter(Modules\Context\SpecialStatus::getModule($form_id)->pluck('Designation')->toArray())
                : [],
        ];
    }

    /**
     * Provide the list of prioritized key elements
     */
    public static function getPrioritizedElements(?int $form_id): array
    {
        return collect(static::getModuleRecords($form_id)['records'])
            ->filter(function (array $item) {
                return $item['IncludeInStatistics'];
            })
            ->pluck('Aspect')
            ->toArray();
    }

    protected static function getRecordsToBeDropped($records, $form_id, $dependency_on): array
    {
        // Get list of values (of reference field) from DB and from updated records
        $existing_values = static::getModule($form_id)
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
