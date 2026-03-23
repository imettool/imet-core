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

final class KeyConservationElements extends ImetModule_Report
{
    protected $table = 'report_key_conservation_elements';

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'TABLE';
        $this->module_title = trans('imet-core::v2_report.KeyConservationElements.title');
        $this->module_code = 'RP 4A';

        $this->module_fields = [
            ['name' => 'num_kce',           'type' => 'disabled',   'label' => trans('imet-core::v2_report.KeyConservationElements.fields.num_kce')],
            ['name' => 'kces',               'type' => 'text-area',   'label' => trans('imet-core::v2_report.KeyConservationElements.fields.kces')],
            ['name' => 'targets_and_es',    'type' => 'text-area',   'label' => trans('imet-core::v2_report.KeyConservationElements.fields.targets_and_es')],
            ['name' => 'kea',               'type' => 'text-area',   'label' => trans('imet-core::v2_report.KeyConservationElements.fields.kea')],
            ['name' => 'threats',           'type' => 'text-area',   'label' => trans('imet-core::v2_report.KeyConservationElements.fields.threats')],
            ['name' => 'note',              'type' => 'text-area',   'label' => trans('imet-core::v2_report.KeyConservationElements.fields.note')],
        ];

        $this->module_info = trans('imet-core::v2_report.KeyConservationElements.module_info');
        $this->fieldsDefinitions = trans('imet-core::v2_report.KeyConservationElements.definitions');

        $this->predefined_values = [
            'field' => 'num_kce',
            'values' => ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
        ];
        $this->max_rows = 10;

        parent::__construct($attributes);
    }

}
