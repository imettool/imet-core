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

class _Objectives extends Modules\Component\ImetModule
{
    public function __construct(array $attributes = [])
    {

        $this->module_type = 'TABLE';
        $this->module_title = trans('imet-core::v2_evaluation._Objectives.title');
        $this->module_fields = [
            ['name' => 'Element',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation._Objectives.fields.Element')],
            ['name' => 'Status',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation._Objectives.fields.Status')],
            ['name' => 'Objective',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation._Objectives.fields.Objective')],
        ];

        $this->module_common_fields = [
            ['name' => 'comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_evaluation._Objectives.fields.comments')],
        ];

        parent::__construct($attributes);
    }
}
