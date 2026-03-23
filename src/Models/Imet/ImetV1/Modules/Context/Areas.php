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

final class Areas extends Modules\Component\ImetModule
{
    protected $table = 'context_areas';

    public int $label_width = 5;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 2.2';
        $this->module_title = trans('imet-core::v1_context.Areas.title');
        $this->module_fields = [
            [
                'name' => 'AdministrativeArea',
                'type' => 'integer',
                'label' => trans('imet-core::v1_context.Areas.fields.AdministrativeArea'),
            ],
            [
                'name' => 'WDPAArea',
                'type' => 'integer',
                'label' => trans('imet-core::v1_context.Areas.fields.WDPAArea'),
            ],
            [
                'name' => 'GISArea',
                'type' => 'integer',
                'label' => trans('imet-core::v1_context.Areas.fields.GISArea'),
            ],
            [
                'name' => 'TerrestrialArea',
                'type' => 'integer',
                'label' => trans('imet-core::v1_context.Areas.fields.TerrestrialArea'),
            ],
            [
                'name' => 'MarineArea',
                'type' => 'integer',
                'label' => trans('imet-core::v1_context.Areas.fields.MarineArea'),
            ],
            [
                'name' => 'PercentageNationalNetwork',
                'type' => 'integer',
                'label' => trans('imet-core::v1_context.Areas.fields.PercentageNationalNetwork'),
            ],
            [
                'name' => 'PercentageEcoregion',
                'type' => 'integer',
                'label' => trans('imet-core::v1_context.Areas.fields.PercentageEcoregion'),
            ],
            [
                'name' => 'PercentageTransnationalNetwork',
                'type' => 'integer',
                'label' => trans('imet-core::v1_context.Areas.fields.PercentageTransnationalNetwork'),
            ],
            [
                'name' => 'PercentageLandscapeNetwork',
                'type' => 'integer',
                'label' => trans('imet-core::v1_context.Areas.fields.PercentageLandscapeNetwork'),
            ],
            [
                'name' => 'Index',
                'type' => 'text-area',
                'label' => trans('imet-core::v1_context.Areas.fields.Index'),
            ],
        ];

        $this->module_common_fields = [
            [
                'name' => 'Observations',
                'type' => 'text-area',
                'label' => trans('imet-core::v1_context.Areas.fields.Observations'),
            ],
        ];

        parent::__construct($attributes);
    }

    public static function getArea(?int $form_id): int|float|null
    {
        $areas = self::getModuleRecords($form_id)['records'];
        $area = 0;
        if (count($areas) > 0 && array_key_exists('AdministrativeArea', $areas[0])) {
            $area = $areas[0]['AdministrativeArea'];
        }

        return $area === 0 ? null : $area / 100; // ha->km2
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'Areas',
            'fields' => [
                'AdministrativeArea', 'WDPAArea', 'GISArea', 'TerrestrialArea', 'MarineArea',
                'PercentageNationalNetwork', 'PercentageEcoregion', 'PercentageTransnationalNetwork', 'PercentageLandscapeNetwork', 'Index',
                'Observations',
            ],
        ];
    }
}
