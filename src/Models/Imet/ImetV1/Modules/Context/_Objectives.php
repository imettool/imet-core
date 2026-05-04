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

namespace ImetCore\Models\Imet\ImetV1\Modules\Context;

use ImetCore\Models\Imet\ImetV1\Modules;
use ModularForms\Enums\ModuleTypes;

class _Objectives extends Modules\Component\ImetModule
{
    public function __construct(array $attributes = [])
    {

        $this->module_type = ModuleTypes::TABLE;
        $this->module_title = trans('imet-core::v1_context.Objectives.title');
        $this->module_fields = [
            ['name' => 'Status',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.Objectives.fields.Status')],
            ['name' => 'Benchmark1',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.Objectives.fields.Benchmark1')],
            ['name' => 'Benchmark2',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.Objectives.fields.Benchmark2')],
            ['name' => 'Benchmark3',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.Objectives.fields.Benchmark3')],
            ['name' => 'Objective',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.Objectives.fields.Objective')],
        ];

        parent::__construct($attributes);

    }
}
