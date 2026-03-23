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

namespace ImetCore\Models\Imet\ImetV2\Modules\Context;

use ImetCore\Models\Imet\ImetV2\Modules;
use ImetCore\Models\User\Role;

class ResponsablesInterviewers extends Modules\Component\ImetModule
{
    protected $table = 'context_encoding_responsables_interviewers';

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 1.0.1';
        $this->module_title = trans('imet-core::common.ResponsablesInterviewers.title');
        $this->module_fields = [
            ['name' => 'Name',              'type' => 'text-area',       'label' => trans('imet-core::common.ResponsablesInterviewers.fields.Name'),         'class' => 'width300px'],
            ['name' => 'Institution',       'type' => 'text-area',       'label' => trans('imet-core::common.ResponsablesInterviewers.fields.Institution'),  'class' => 'width300px'],
            ['name' => 'Function',          'type' => 'text-area',       'label' => trans('imet-core::common.ResponsablesInterviewers.fields.Function')],
            ['name' => 'Contacts',          'type' => 'text-area',       'label' => trans('imet-core::common.ResponsablesInterviewers.fields.Contacts')],
        ];

        $this->module_common_fields = [
            ['name' => 'EncodingDate',      'type' => 'date',       'label' => trans('imet-core::common.ResponsablesInterviewers.fields.EncodingDate')],
            ['name' => 'EncodingDuration',  'type' => 'text-area',       'label' => trans('imet-core::common.ResponsablesInterviewers.fields.EncodingDuration')],
        ];

        parent::__construct($attributes);
    }

    public static function getNames(?int $form_id)
    {
        return self::getModule($form_id)
            ->map->only(['Name', 'Institution', 'Function'])
            ->toArray();
    }
}
