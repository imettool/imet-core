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

namespace ImetCore\Models\Imet\ImetV1\Modules\Context;

use ImetCore\Models\Imet\ImetV1\Modules;
use ImetCore\Models\User\Role;

final class ClimateChangeImportanceElements extends Modules\Component\ImetModule
{
    protected $table = 'context_climate_change_importance_elements';

    public bool $fixed_rows = true;

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'ACCORDION';
        $this->module_code = 'CTX 6.1';
        $this->module_title = trans('imet-core::v1_context.ClimateChangeImportanceElements.title');
        $this->module_fields = [
            ['name' => 'GroupElement',  'type' => 'text-area',        'label' => trans('imet-core::v1_context.ClimateChangeImportanceElements.fields.GroupElement')],
            ['name' => 'Element',       'type' => 'text-area',   'label' => trans('imet-core::v1_context.ClimateChangeImportanceElements.fields.Element')],
            ['name' => 'Application',   'type' => 'rating-0to3', 'label' => trans('imet-core::v1_context.ClimateChangeImportanceElements.fields.Application')],
            ['name' => 'Observations',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.ClimateChangeImportanceElements.fields.Observations')],
        ];

        $this->predefined_values = [
            'field' => 'GroupElement',
            'values' => trans('imet-core::v1_context.ClimateChangeImportanceElements.predefined_values'),
        ];

        $this->module_info = trans('imet-core::v1_context.ClimateChangeImportanceElements.module_info');
        $this->ratingLegend = trans('imet-core::v1_context.ClimateChangeImportanceElements.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'ClimateChangeImportanceElements',
            'fields' => [
                'GroupElement', 'Element', 'Application', 'Observations',
            ],
        ];
    }
}
