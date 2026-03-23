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
use ImetCore\Services\StakeholdersService;
use ImetCore\Services\ThreatsService;

final class Threats extends Modules\Component\ImetModule_Eval
{
    protected $table = 'eval_threats';

    public bool $fixed_rows = true;

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::oecm.evaluation.edit.modules.threats';
    public const string BODY_SHOW_BLADE_VIEW = 'imet-core::oecm.evaluation.show.modules.threats';

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'TABLE';
        $this->module_code = 'C3.1.2';
        $this->module_title = trans('imet-core::oecm_evaluation.Threats.title');
        $this->module_fields = [
            ['name' => 'Value',         'type' => 'disabled', 'label' => trans('imet-core::oecm_evaluation.Threats.fields.Value')],
            ['name' => 'Impact',        'type' => 'rating-0to3',        'label' => trans('imet-core::oecm_evaluation.Threats.fields.Impact')],
            ['name' => 'Extension',     'type' => 'rating-0to3',        'label' => trans('imet-core::oecm_evaluation.Threats.fields.Extension')],
            ['name' => 'Duration',      'type' => 'rating-0to3',        'label' => trans('imet-core::oecm_evaluation.Threats.fields.Duration')],
            ['name' => 'Trend',         'type' => 'rating-Minus2to2',   'label' => trans('imet-core::oecm_evaluation.Threats.fields.Trend')],
            ['name' => 'Probability',   'type' => 'rating-0to3',        'label' => trans('imet-core::oecm_evaluation.Threats.fields.Probability')],
        ];

        $this->predefined_values = [
            'field' => 'Value',
            'values' => trans('imet-core::oecm_lists.Threats'),
        ];

        $this->module_info_EvaluationQuestion = trans('imet-core::oecm_evaluation.Threats.module_info_EvaluationQuestion');
        $this->module_info_Rating = trans('imet-core::oecm_evaluation.Threats.module_info_Rating');
        $this->ratingLegend = trans('imet-core::oecm_evaluation.Threats.ratingLegend');

        parent::__construct($attributes);
    }

    protected static function arrange_records(?array $predefined_values, array $records, array $empty_record): array
    {
        $form_id = $empty_record['FormID'];

        $records = parent::arrange_records($predefined_values, $records, $empty_record);

        $stakeholder_records = StakeholdersService::getAllRecords($form_id);
        $threats = StakeholdersService::keyElementsByThreat($stakeholder_records);

        // Inject num stakeholders and elements
        foreach ($records as $index => $record) {
            $threat_key = array_search($record['Value'], trans('imet-core::oecm_lists.Threats'), true);

            $records[$index]['__count_stakeholders_direct'] = null;
            $records[$index]['__count_stakeholders_indirect'] = null;
            $records[$index]['__elements_legal_list'] = null;
            $records[$index]['__elements_illegal_list'] = null;
            $records[$index]['__threat_key'] = $threat_key;

            if (array_key_exists($threat_key, $threats)) {
                $records[$index]['__count_stakeholders_direct'] = $threats[$threat_key]['count_stakeholders_direct'];
                $records[$index]['__count_stakeholders_indirect'] = $threats[$threat_key]['count_stakeholders_indirect'];
                $records[$index]['__elements_legal_list'] = $threats[$threat_key]['elements_legal_list'];
                $records[$index]['__elements_illegal_list'] = $threats[$threat_key]['elements_illegal_list'];
            }

        }

        return $records;
    }

    /**
     * Calculate threat's ranking
     */
    public static function calculateRanking(?int $form_id, ?array $records = null): array
    {
        $records ??= self::getModuleRecords($form_id)['records'];

        return ThreatsService::calculateRanking($records);
    }
}
