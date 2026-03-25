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

final class GeographicalLocation extends Modules\Component\ImetModule
{
    protected $table = 'context_localization';

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::v2.context.edit.modules.geographical_location';

    public const string BODY_SHOW_BLADE_VIEW = 'imet-core::v2.context.show.modules.geographical_location';

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 2.1';
        $this->module_title = trans('imet-core::v2_context.GeographicalLocation.title');
        $this->module_fields = [
            ['name' => 'LimitsExist',  'type' => 'toggle-yes_no',   'label' => trans('imet-core::v2_context.GeographicalLocation.fields.LimitsExist')],
            ['name' => 'Shapefile',  'type' => 'upload',   'label' => trans('imet-core::v2_context.GeographicalLocation.fields.Shapefile')],
            ['name' => 'SourceSHP',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.GeographicalLocation.fields.SourceSHP')],
            ['name' => 'Coordinates',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.GeographicalLocation.fields.Coordinates')],
            ['name' => 'SourceCoords',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.GeographicalLocation.fields.SourceCoords')],
            ['name' => 'AdministrativeLocation',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.GeographicalLocation.fields.AdministrativeLocation')],
        ];

        $this->module_info = trans('imet-core::v2_context.GeographicalLocation.module_info');

        parent::__construct($attributes);
    }
}
