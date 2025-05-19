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

namespace ImetCore\Models\Imet\oecm\Modules\Context;

use ImetCore\Models\Imet\oecm\Modules;
use ImetCore\Models\User\Role;

class ResponsablesInterviewees extends Modules\Component\ImetModule
{
    protected $table = 'context_encoding_responsables_interviewees';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 1.0.2';
        $this->module_title = trans('imet-core::common.ResponsablesInterviewees.title');
        $this->module_fields = [
            ['name' => 'Name',              'type' => 'text-area',       'label' => trans('imet-core::common.ResponsablesInterviewees.fields.Name'),         'class' => 'width300px'],
            ['name' => 'Institution',       'type' => 'text-area',       'label' => trans('imet-core::common.ResponsablesInterviewees.fields.Institution'),  'class' => 'width300px'],
            ['name' => 'Function',          'type' => 'text-area',       'label' => trans('imet-core::common.ResponsablesInterviewees.fields.Function')],
            ['name' => 'Contacts',          'type' => 'text-area',       'label' => trans('imet-core::common.ResponsablesInterviewees.fields.Contacts')]
        ];

        $this->module_common_fields = [
            ['name' => 'EncodingDate',      'type' => 'date',       'label' => trans('imet-core::common.ResponsablesInterviewees.fields.EncodingDate')],
            ['name' => 'EncodingDuration',  'type' => 'text-area',       'label' => trans('imet-core::common.ResponsablesInterviewees.fields.EncodingDuration')]
        ];

        parent::__construct($attributes);
    }

    public static function getNames($form_id)
    {
        return static::getModule($form_id)
            ->map->only(['Name', 'Institution', 'Function'])
            ->toArray();
    }
}
