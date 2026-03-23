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

namespace ImetCore\Models\Imet\ImetOecm\Modules\Context;

use ImetCore\Models\Imet\ImetOecm\Modules;
use ImetCore\Models\User\Role;

final class Networks extends Modules\Component\ImetModule
{
    protected $table = 'context_networks';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 1.4';
        $this->module_title = trans('imet-core::oecm_context.Networks.title');
        $this->module_fields = [
            ['name' => 'NetworkName',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.Networks.fields.NetworkName')],
            ['name' => 'ProtectedAreas',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.Networks.fields.ProtectedAreas')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::oecm_context.Networks.groups.group0'),
            'group1' => trans('imet-core::oecm_context.Networks.groups.group1'),
            'group2' => trans('imet-core::oecm_context.Networks.groups.group2'),
        ];

        parent::__construct($attributes);
    }
}
