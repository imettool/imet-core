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

class ControlLevel extends Modules\Component\ImetModule
{
    protected $table = 'context_control_level';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 2.3';
        $this->module_title = trans('imet-core::v1_context.ControlLevel.title');
        $this->module_fields = [
            ['name' => 'UnderControlArea',              'type' => 'integer',   'label' => trans('imet-core::v1_context.ControlLevel.fields.UnderControlArea')],
            ['name' => 'UnderControlPatrolManDay',      'type' => 'integer',   'label' => trans('imet-core::v1_context.ControlLevel.fields.UnderControlPatrolManDay')],
            ['name' => 'UnderControlPatrolKm',          'type' => 'integer',   'label' => trans('imet-core::v1_context.ControlLevel.fields.UnderControlPatrolKm')],
            ['name' => 'EcologicalMonitoringPatrolKm',  'type' => 'integer',   'label' => trans('imet-core::v1_context.ControlLevel.fields.EcologicalMonitoringPatrolKm')],
            ['name' => 'Source',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.ControlLevel.fields.Source')],
            ['name' => 'Observations',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.ControlLevel.fields.Observations')],
        ];

        parent::__construct($attributes);

    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'ControlLevel',
            'fields' => [
                'UnderControlArea', 'UnderControlPatrolManDay', 'UnderControlPatrolKm', 'EcologicalMonitoringPatrolKm',
                'Source', 'Observations',
            ],
        ];
    }

    public static function areaPercentage(array $record, $area): ?float
    {

        $result = null;
        $value = $record['UnderControlArea'];
        $value2 = $area;
        if (static::isValid($value2) && static::isValid($value) && $value > 0) {
            $result = (float) ($value) / (float) ($value2) * 100;
            $result = round($result, 2);
        }

        return $result;
    }

    public static function averageTime(array $record, $area): ?float
    {
        $result = null;
        $value = $record['UnderControlPatrolManDay'];
        $value2 = $area;
        if (static::isValid($value2) && static::isValid($value) && $value > 0) {
            $result = (float) ($value) / (float) ($value2);
            $result = round($result, 2);
        }

        return $result;
    }

    public static function areaPercentageConversion(array $record, $area): ?float
    {
        $result = null;
        $value = $record['UnderControlPatrolKm'];
        $value2 = $area;
        if (static::isValid($value2) && static::isValid($value) && $value > 0) {
            $result = (float) ($value) / (float) ($value2) * 10;
            $result = round($result, 2);
        }

        return $result;
    }

    public static function averageTimeControlled(array $record, $area): ?float
    {
        $result = null;
        $value = $record['UnderControlPatrolKm'];
        $value2 = $record['UnderControlArea'];
        if (static::isValid($area) && static::isValid($value) && $value > 0) {
            $result = (float) ($value) / (float) ($value2);
            $result = round($result, 2);
        }

        return $result;
    }

    public static function ecologicalMonitoringPatrolKmPercentage(array $record, $area): ?float
    {
        $result = null;
        $value = $record['EcologicalMonitoringPatrolKm'];
        $value2 = $area;
        if (static::isValid($value2) && static::isValid($value) && $value > 0) {
            $result = (float) ($value) / (float) ($value2) * 10;
            $result = round($result, 2);
        }

        return $result;
    }

    private static function isValid($value): bool
    {
        return ! is_infinite($value) && $value > 0;
    }
}
