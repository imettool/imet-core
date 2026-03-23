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

namespace ImetCore\Models\Imet\ImetV2\Modules\Report;

use ImetCore\Models\Imet\ImetV2\Modules\Component\ImetModule_Report;

final class ThreatsAffectingKCEs extends ImetModule_Report
{
    protected $table = 'report_threats_affecting_kces';

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'TABLE';
        $this->module_title = trans('imet-core::v2_report.ThreatsAffectingKCEs.title');
        $this->module_code = 'RP 4B';

        $this->module_fields = [
            ['name' => 'num_threat',    'type' => 'disabled'],
            ['name' => 'threat',    'type' => 'text-area',  'label' => trans('imet-core::v2_report.ThreatsAffectingKCEs.fields.threat')],
            ['name' => 'kce1',      'type' => 'rating-0to4',  'label' => trans('imet-core::v2_report.ThreatsAffectingKCEs.fields.kce1')],
            ['name' => 'kce2',      'type' => 'rating-0to4',  'label' => trans('imet-core::v2_report.ThreatsAffectingKCEs.fields.kce2')],
            ['name' => 'kce3',      'type' => 'rating-0to4',  'label' => trans('imet-core::v2_report.ThreatsAffectingKCEs.fields.kce3')],
            ['name' => 'kce4',      'type' => 'rating-0to4',  'label' => trans('imet-core::v2_report.ThreatsAffectingKCEs.fields.kce4')],
            ['name' => 'kce5',      'type' => 'rating-0to4',  'label' => trans('imet-core::v2_report.ThreatsAffectingKCEs.fields.kce5')],
            ['name' => 'kce6',      'type' => 'rating-0to4',  'label' => trans('imet-core::v2_report.ThreatsAffectingKCEs.fields.kce6')],
            ['name' => 'kce7',      'type' => 'rating-0to4',  'label' => trans('imet-core::v2_report.ThreatsAffectingKCEs.fields.kce7')],
            ['name' => 'kce8',      'type' => 'rating-0to4',  'label' => trans('imet-core::v2_report.ThreatsAffectingKCEs.fields.kce8')],
            ['name' => 'kce9',      'type' => 'rating-0to4',  'label' => trans('imet-core::v2_report.ThreatsAffectingKCEs.fields.kce9')],
            ['name' => 'kce10',     'type' => 'rating-0to4',  'label' => trans('imet-core::v2_report.ThreatsAffectingKCEs.fields.kce10')],
        ];

        $this->module_info = trans('imet-core::v2_report.ThreatsAffectingKCEs.module_info');
        $this->fieldsDefinitions = trans('imet-core::v2_report.ThreatsAffectingKCEs.definitions');
        $this->ratingLegend = trans('imet-core::v2_report.ThreatsAffectingKCEs.ratingLegend');

        $this->predefined_values = [
            'field' => 'num_threat',
            'values' => ['1', '2', '3', '4', '5', '6', '7', '8'],
        ];
        $this->max_rows = 8;

        parent::__construct($attributes);
    }

}
