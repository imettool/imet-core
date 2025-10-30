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

namespace ImetCore\Models\Imet\v1\Modules\Context;

use ImetCore\Models\Imet\v1\Modules;
use ImetCore\Models\User\Role;

final class ManagementStaffPartners extends Modules\Component\ImetModule
{
    protected $table = 'context_management_staff_partners';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 3.1.2';
        $this->module_title = trans('imet-core::v1_context.ManagementStaffPartners.title');
        $this->module_fields = [
            ['name' => 'Partner',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.ManagementStaffPartners.fields.Partner')],
            ['name' => 'Coordinators',  'type' => 'integer',   'label' => trans('imet-core::v1_context.ManagementStaffPartners.fields.Coordinators')],
            ['name' => 'Technicians',  'type' => 'integer',   'label' => trans('imet-core::v1_context.ManagementStaffPartners.fields.Technicians')],
            ['name' => 'Auxiliaries',  'type' => 'integer',   'label' => trans('imet-core::v1_context.ManagementStaffPartners.fields.Auxiliaries')],
        ];

        parent::__construct($attributes);
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'ManagementStaffPartners',
            'fields' => [
                'Partner', 'Coordinators', 'Technicians', 'Auxiliaries',
            ],
        ];
    }
}
