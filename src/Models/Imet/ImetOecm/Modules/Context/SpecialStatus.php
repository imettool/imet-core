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
use ModularForms\Enums\ModuleTypes;

final class SpecialStatus extends Modules\Component\ImetModule
{
    protected $table = 'context_special_status';

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public static array $exclude_raw_fields = ['upload'];

    public function __construct(array $attributes = [])
    {

        $this->module_type = ModuleTypes::GROUP_ACCORDION;
        $this->module_code = 'CTX 1.3';
        $this->module_title = trans('imet-core::oecm_context.SpecialStatus.title');
        $this->module_fields = [
            ['name' => 'Designation',           'type' => 'text-area',   'label' => trans('imet-core::oecm_context.SpecialStatus.fields.Designation')],
            ['name' => 'RegistrationDate',      'type' => 'dateMaxToday',   'label' => trans('imet-core::oecm_context.SpecialStatus.fields.RegistrationDate')],
            ['name' => 'Code',                  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.SpecialStatus.fields.Code')],
            ['name' => 'Area',                  'type' => 'numeric',   'label' => trans('imet-core::oecm_context.SpecialStatus.fields.Area')],
            ['name' => 'DesignationCriteria',   'type' => 'text-area',   'label' => trans('imet-core::oecm_context.SpecialStatus.fields.DesignationCriteria')],
            ['name' => 'upload',                'type' => 'upload',   'label' => trans('imet-core::oecm_context.SpecialStatus.fields.upload')],
        ];

        $this->module_groups = [
            'conventions' => trans('imet-core::oecm_context.SpecialStatus.groups.conventions'),
            'networks' => trans('imet-core::oecm_context.SpecialStatus.groups.networks'),
            'conservation' => trans('imet-core::oecm_context.SpecialStatus.groups.conservation'),
            'marine_pa' => trans('imet-core::oecm_context.SpecialStatus.groups.marine_pa'),
        ];

        parent::__construct($attributes);
    }
}
