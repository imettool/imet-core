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
use ModularForms\Models\Traits\Payload;
use Exception;
use Illuminate\Http\Request;

/**
 * @property $titles
 */
class ThreatsIntegration extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_threats_integration';
    protected bool $fixed_rows = true;
    public $titles = [];

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;
    protected static $DEPENDENCIES = [
        [Objectives::class, 'Threat'],
        [Modules\Evaluation\InformationAvailability::class, 'Threat']
    ];

    protected static array $extra_raw_fields = ['Ranking' => '__score'];

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'C3.2';
        $this->module_title = trans('imet-core::oecm_evaluation.ThreatsIntegration.title');
        $this->module_fields = [
            ['name' => 'Threat',           'type' => 'blade-imet-core::oecm.evaluation.fields.threat_with_ranking',   'label' => trans('imet-core::oecm_evaluation.ThreatsIntegration.fields.Threat')],
            ['name' => 'Integration',       'type' => 'rating-0to3',   'label' => trans('imet-core::oecm_evaluation.ThreatsIntegration.fields.Integration')],
            ['name' => 'IncludeInStatistics',   'type' => 'checkbox-boolean',   'label' => trans('imet-core::oecm_evaluation.ThreatsIntegration.fields.IncludeInStatistics')],
            ['name' => 'Comments',              'type' => 'text-area',   'label' => trans('imet-core::oecm_evaluation.ThreatsIntegration.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Threat',
            'values' => trans('imet-core::oecm_lists.Threats')
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.ThreatsIntegration.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.ThreatsIntegration.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.ThreatsIntegration.ratingLegend');

        parent::__construct($attributes);
    }

    protected static function arrange_records($predefined_values, $records, $empty_record): array
    {
        $form_id = $empty_record['FormID'];

        $records = parent::arrange_records($predefined_values, $records, $empty_record);

        $threats_ranking = collect(Threats::calculateRanking($form_id))
            ->pluck('__score', 'Value')
            ->toArray();

        foreach ($records as $index => $record){
            $records[$index]['__score'] = $threats_ranking[$record['Threat']];
        }

        return collect($records)
            ->sortBy('__score')
            ->values()
            ->all();
    }

    /**
     * Provide the list of prioritized key elements
     * @param $form_id
     */
    public static function getPrioritizedElements($form_id): array
    {
        return collect(static::getModuleRecords($form_id)['records'])
            ->filter(function ($item) {
                return $item['IncludeInStatistics'];
            })
            ->pluck('Threat')
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
