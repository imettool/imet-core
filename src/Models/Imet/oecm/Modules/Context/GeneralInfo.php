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

final class GeneralInfo extends Modules\Component\ImetModule
{
    protected $table = 'context_general_info';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 1.1';
        $this->module_title = trans('imet-core::oecm_context.GeneralInfo.title');
        $this->module_fields = [
            ['name' => 'CompleteName',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.GeneralInfo.fields.CompleteName')],
            ['name' => 'UsedName',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.GeneralInfo.fields.UsedName')],
            ['name' => 'CompleteNameWDPA',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.GeneralInfo.fields.CompleteNameWDPA')],
            ['name' => 'WDPA',  'type' => 'code',   'label' => trans('imet-core::oecm_context.GeneralInfo.fields.WDPA')],
            ['name' => 'Type',  'type' => 'blade-imet-core::oecm.context.fields.ctx11_type',   'label' => trans('imet-core::oecm_context.GeneralInfo.fields.Type')],
            ['name' => 'Country',  'type' => 'dropdown-Imet_Country',   'label' => trans('imet-core::oecm_context.GeneralInfo.fields.Country')],
            ['name' => 'CreationYear',  'type' => 'year',   'label' => trans('imet-core::oecm_context.GeneralInfo.fields.CreationYear')],
            ['name' => 'ReferenceText',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.GeneralInfo.fields.ReferenceText')],
            ['name' => 'Ownership',  'type' => 'dropdown-ImetV2_OwnershipType',   'label' => trans('imet-core::oecm_context.GeneralInfo.fields.Ownership')],
            ['name' => 'Importance',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.GeneralInfo.fields.Importance')],
        ];

        $this->module_info = trans('imet-core::oecm_context.GeneralInfo.module_info');

        parent::__construct($attributes);
    }
}
