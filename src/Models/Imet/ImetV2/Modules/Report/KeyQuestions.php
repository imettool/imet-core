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
use ModularForms\Enums\ModuleTypes;

final class KeyQuestions extends ImetModule_Report
{
    protected $table = 'report_key_questions';

    public function __construct(array $attributes = [])
    {
        $this->module_type = ModuleTypes::SIMPLE;
        $this->module_title = trans('imet-core::v2_report.KeyQuestions.title');
        $this->module_code = 'RP 5';

        $this->module_fields = [
            ['name' => 'priorities',            'type' => 'text-editor',     'label' => trans('imet-core::v2_report.KeyQuestions.fields.priorities')],
            ['name' => 'minimum_budget',        'type' => 'text-editor',     'label' => trans('imet-core::v2_report.KeyQuestions.fields.minimum_budget')],
            ['name' => 'additional_funding',    'type' => 'text-editor',     'label' => trans('imet-core::v2_report.KeyQuestions.fields.additional_funding')],
        ];

        parent::__construct($attributes);
    }
}
