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

use ImetCore\Models\Imet\ImetV2\Modules;
use ImetCore\Models\User\Role;

final class ImportanceClimateChange extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_importance_c15';

    public bool $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCY_ON = 'Aspect';

    protected static $DEPENDENCIES = [
        [Modules\Evaluation\InformationAvailability::class, 'Aspect'],
        [Modules\Evaluation\KeyConservationTrend::class, 'Aspect'],
        [Modules\Evaluation\ManagementActivities::class, 'Aspect'],
        [Modules\Evaluation\ClimateChangeMonitoring::class, 'Aspect'],
    ];

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'TABLE';
        $this->module_code = 'C1.4';
        $this->module_title = trans('imet-core::v2_evaluation.ImportanceClimateChange.title');
        $this->module_fields = [
            ['name' => 'Aspect',  'type' => 'blade-imet-core::v2.evaluation.fields.key_element',   'label' => trans('imet-core::v2_evaluation.ImportanceClimateChange.fields.Aspect')],
            ['name' => 'EvaluationScore',  'type' => 'rating-0to3',   'label' => trans('imet-core::v2_evaluation.ImportanceClimateChange.fields.EvaluationScore')],
            ['name' => 'IncludeInStatistics',  'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_evaluation.ImportanceClimateChange.fields.IncludeInStatistics')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation.ImportanceClimateChange.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Aspect',
            'values' => null,
        ];

        $this->module_subTitle = trans('imet-core::v2_evaluation.ImportanceClimateChange.module_subTitle');
        $this->module_info_EvaluationQuestion = trans('imet-core::v2_evaluation.ImportanceClimateChange.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::v2_evaluation.ImportanceClimateChange.module_info_Rating');
        $this->ratingLegend = trans('imet-core::v2_evaluation.ImportanceClimateChange.ratingLegend');

        parent::__construct($attributes);

    }

    /**
     * Prefill from CTX
     */
    #[\Override]
    public static function getPredefined(?int $form_id = null): array
    {
        if ($form_id !== null) {
            $ctx_records = Modules\Context\ClimateChange::getModule($form_id)
                ->filter(fn ($item): bool => $item['Value'] !== null)
                ->filter()
                ->sortByDesc('Trend');

            // Filter first 10
            if (count($ctx_records) > 10) {
                $max_allowed_rank = array_values($ctx_records->toArray())[9]['Trend'];
                $ctx_records = $ctx_records
                    ->filter(fn ($item): bool => $item['Trend'] <= $max_allowed_rank);
            }
        }

        return [
            'field' => self::$DEPENDENCY_ON,
            'values' => $form_id !== null
                ? $ctx_records
                    ->map(fn ($item): mixed => $item['Value'])
                : [],
        ];
    }
}
