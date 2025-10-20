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

final class ClimateChange extends Modules\Component\ImetModule
{
    protected $table = 'context_climate_change_changements';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 6.2';
        $this->module_title = trans('imet-core::v1_context.ClimateChange.title');
        $this->module_fields = [
            ['name' => 'Value',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.ClimateChange.fields.Value')],
            ['name' => 'Description',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.ClimateChange.fields.Description')],
            ['name' => 'DesiredStatus',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.ClimateChange.fields.DesiredStatus')],
            ['name' => 'Trend',  'type' => 'rating-Minus3to3',   'label' => trans('imet-core::v1_context.ClimateChange.fields.Trend')],
            ['name' => 'Notes',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.ClimateChange.fields.Notes')],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v1_context.ClimateChange.groups.group0'),
            'group1' => trans('imet-core::v1_context.ClimateChange.groups.group1'),
            'group2' => trans('imet-core::v1_context.ClimateChange.groups.group2'),
            'group3' => trans('imet-core::v1_context.ClimateChange.groups.group3'),
            'group4' => trans('imet-core::v1_context.ClimateChange.groups.group4'),
            'group5' => trans('imet-core::v1_context.ClimateChange.groups.group5'),
        ];

        $this->module_info = trans('imet-core::v1_context.ClimateChange.module_info');
        $this->ratingLegend = trans('imet-core::v1_context.ClimateChange.ratingLegend');

        parent::__construct($attributes);

    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'ClimateChangeChangements',
            'fields' => [
                'Value', 'Description', 'DesiredStatus', 'Trend', 'Notes', 'Group',
            ],
        ];
    }

    /**
     * Review data from SQLITE
     */
    protected static function conversionDataReview(array $record, $sqlite_connection): array
    {
        return self::convertGroupLabelToKey($record, 'Group');
    }
}
