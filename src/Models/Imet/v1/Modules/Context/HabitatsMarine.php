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

class HabitatsMarine extends Modules\Component\ImetModule
{
    protected $table = 'context_habitats_marine';
    protected bool $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'ACCORDION';
        $this->module_code = 'CTX 4.3.2';
        $this->module_title = trans('imet-core::v1_context.HabitatsMarine.title');
        $this->module_fields = [
            ['name' => 'HabitatType',   'type' => 'text-area',   'label' => trans('imet-core::v1_context.HabitatsMarine.fields.HabitatType')],
            ['name' => 'Presence',      'type' => 'dropdown-ImetV1_MarineHabitatsPresence',   'label' => trans('imet-core::v1_context.HabitatsMarine.fields.Presence')],
            ['name' => 'Area',          'type' => 'integer',   'label' => trans('imet-core::v1_context.HabitatsMarine.fields.Area')],
            ['name' => 'Fragmentation', 'type' => 'text-area',   'label' => trans('imet-core::v1_context.HabitatsMarine.fields.Fragmentation')],
            ['name' => 'Source',        'type' => 'text-area',   'label' => trans('imet-core::v1_context.HabitatsMarine.fields.Source')],
            ['name' => 'Description',   'type' => 'text-area',   'label' => trans('imet-core::v1_context.HabitatsMarine.fields.Description')],
        ];

        $this->predefined_values = [
            'field' => 'HabitatType',
            'values' => trans('imet-core::v1_context.HabitatsMarine.predefined_values')
        ];

        $this->module_info = trans('imet-core::v1_context.HabitatsMarine.module_info');

        parent::__construct($attributes);
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     *
     * @return array
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'HabitatsMarine',
            'fields' => [
                'HabitatType', 'Presence', 'Area', 'Fragmentation', 'Source', 'Description'
            ]
        ];
    }
}
