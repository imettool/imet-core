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

final class ManagementStaff extends Modules\Component\ImetModule
{
    protected $table = 'context_management_staff';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 3.1.1';
        $this->module_title = trans('imet-core::v2_context.ManagementStaff.title');
        $this->module_fields = [
            ['name' => 'Function',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.ManagementStaff.fields.Function')],
            ['name' => 'ExpectedPermanent',  'type' => 'integer',   'label' => trans('imet-core::v2_context.ManagementStaff.fields.ExpectedPermanent')],
            ['name' => 'ActualPermanent',  'type' => 'integer',   'label' => trans('imet-core::v2_context.ManagementStaff.fields.ActualPermanent')],
            ['name' => 'ActualPermanentPartnersOrCommunities',  'type' => 'integer',   'label' => trans('imet-core::v2_context.ManagementStaff.fields.ActualPermanentPartnersOrCommunities')],
            ['name' => 'Observations',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.ManagementStaff.fields.Observations')],
        ];

        $this->module_common_fields = [
            ['name' => 'Source',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.ManagementStaff.fields.Source')],
        ];

        $this->max_rows = 14;

        $this->module_info = trans('imet-core::v2_context.ManagementStaff.module_info');

        parent::__construct($attributes);

    }
}
