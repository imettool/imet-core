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

namespace ImetCore\Models\Imet\v2\Modules\Context;

use ImetCore\Models\Imet\v2\Modules;
use ImetCore\Models\User\Role;

final class ManagementStaffCommunities extends Modules\Component\ImetModule
{
    protected $table = 'context_management_staff_communities';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 3.1.3';
        $this->module_title = trans('imet-core::v2_context.ManagementStaffCommunities.title');
        $this->module_fields = [
            ['name' => 'Community',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.ManagementStaffCommunities.fields.Community')],
            ['name' => 'Role1',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.ManagementStaffCommunities.fields.Role1')],
            ['name' => 'StaffNUmberRole1',  'type' => 'integer',   'label' => trans('imet-core::v2_context.ManagementStaffCommunities.fields.StaffNUmberRole1')],
        ];

        parent::__construct($attributes);
    }
}
