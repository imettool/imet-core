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

final class Sectors extends Modules\Component\ImetModule
{
    protected $table = 'context_sectors';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::v2.context.edit.modules.sectors';
    public const string BODY_SHOW_BLADE_VIEW = 'imet-core::v2.context.show.modules.sectors';

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 2.3';
        $this->module_title = trans('imet-core::v2_context.Sectors.title');
        $this->module_fields = [
            ['name' => 'Name',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Sectors.fields.Name')],
            ['name' => 'TerrestrialOrMarine',  'type' => 'dropdown-ImetV2_TerrestrialOrMarine',   'label' => trans('imet-core::v2_context.Sectors.fields.TerrestrialOrMarine')],
            ['name' => 'UnderControlArea',  'type' => 'numeric',   'label' => trans('imet-core::v2_context.Sectors.fields.UnderControlArea')],
            ['name' => 'UnderControlPatrolKm',  'type' => 'numeric',   'label' => trans('imet-core::v2_context.Sectors.fields.UnderControlPatrolKm')],
            ['name' => 'UnderControlPatrolManDay',  'type' => 'numeric',   'label' => trans('imet-core::v2_context.Sectors.fields.UnderControlPatrolManDay')],
        ];

        $this->module_common_fields = [
            ['name' => 'SectorMap',  'type' => 'upload',   'label' => trans('imet-core::v2_context.Sectors.fields.SectorMap')],
            ['name' => 'Source',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Sectors.fields.Source')],
            ['name' => 'Observations',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Sectors.fields.Observations')],
        ];

        $this->module_info = trans('imet-core::v2_context.Sectors.module_info');

        parent::__construct($attributes);
    }
}
