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
use ModularForms\Enums\ModuleTypes;

final class Habitats extends Modules\Component\ImetModule
{
    protected $table = 'context_habitats';

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = [])
    {

        $this->module_type = ModuleTypes::TABLE;
        $this->module_code = 'CTX 4.3.1';
        $this->module_title = trans('imet-core::v1_context.Habitats.title');
        $this->module_fields = [
            ['name' => 'EcosystemType',             'type' => 'text-area',   'label' => trans('imet-core::v1_context.Habitats.fields.EcosystemType')],
            ['name' => 'Value',                     'type' => 'text-area',   'label' => trans('imet-core::v1_context.Habitats.fields.Value')],
            ['name' => 'Area',                      'type' => 'integer',   'label' => trans('imet-core::v1_context.Habitats.fields.Area')],
            ['name' => 'DesiredConservationStatus', 'type' => 'integer',   'label' => trans('imet-core::v1_context.Habitats.fields.DesiredConservationStatus')],
            ['name' => 'Trend',                     'type' => 'rating-Minus2to2',   'label' => trans('imet-core::v1_context.Habitats.fields.Trend')],
            ['name' => 'Reliability',               'type' => 'dropdown-ImetV1_SpeciesReliability',   'label' => trans('imet-core::v1_context.Habitats.fields.Reliability'), 'class' => 'width100px'],
            ['name' => 'Sectors',                   'type' => 'text-area',   'label' => trans('imet-core::v1_context.Habitats.fields.Sectors')],
        ];

        $this->module_info = trans('imet-core::v1_context.Habitats.module_info');
        $this->ratingLegend = trans('imet-core::v1_context.Habitats.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'Habitats',
            'fields' => [
                'EcosystemType',
                'Value',
                'Area',
                'DesiredConservationStatus',
                'Trend',
                'Reliability',
                'Sectors',
            ],
        ];
    }
}
