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

use ImetCore\Helpers\Template;
use ImetCore\Models\Imet\ImetOecm\Modules;
use ImetCore\Models\User\Role;

final class Areas extends Modules\Component\ImetModule
{
    protected $table = 'context_areas';

    public int $label_width = 6;

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::oecm.context.edit.modules.areas';

    public const string BODY_SHOW_BLADE_VIEW = 'imet-core::oecm.context.show.modules.areas';

    public function __construct(array $attributes = [])
    {
        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 2.2';
        $this->module_title = trans('imet-core::oecm_context.Areas.title');
        $this->module_fields = [
            [
                'name' => 'TerrestrialArea',
                'type' => 'numeric',
                'label' => Template::module_scope(self::TERRESTRIAL).' '.trans('imet-core::oecm_context.Areas.fields.TerrestrialArea'),
            ],
            [
                'name' => 'MarineArea',
                'type' => 'numeric',
                'label' => Template::module_scope(self::MARINE).' '.trans('imet-core::oecm_context.Areas.fields.MarineArea'),
            ],
            [
                'name' => 'AdministrativeArea',
                'type' => 'numeric',
                'label' => trans('imet-core::oecm_context.Areas.fields.AdministrativeArea'),
            ],
            ['name' => 'WDPAArea',      'type' => 'numeric', 'label' => trans('imet-core::oecm_context.Areas.fields.WDPAArea')],
            ['name' => 'GISArea',       'type' => 'numeric', 'label' => trans('imet-core::oecm_context.Areas.fields.GISArea')],
            ['name' => 'StrictConservationArea', 'type' => 'numeric', 'label' => trans('imet-core::oecm_context.Areas.fields.StrictConservationArea')],
        ];

        parent::__construct($attributes);
    }

    public static function getArea(?int $form_id): int|float|null
    {
        $areas = self::getModuleRecords($form_id)['records'];
        $area = 0;
        if (count($areas) > 0) {
            $area = null;
            $area = array_key_exists(
                'AdministrativeArea',
                $areas[0]
            ) && $areas[0]['AdministrativeArea'] !== null && $areas[0]['AdministrativeArea'] > 0 ? $areas[0]['AdministrativeArea'] : $area;
            $area = array_key_exists(
                'WDPAArea',
                $areas[0]
            ) && $areas[0]['WDPAArea'] !== null && $areas[0]['WDPAArea'] > 0 ? $areas[0]['WDPAArea'] : $area;
            $area = array_key_exists(
                'GISArea',
                $areas[0]
            ) && $areas[0]['GISArea'] !== null && $areas[0]['GISArea'] > 0 ? $areas[0]['GISArea'] : $area;
        }

        return $area === 0 ? null : $area / 100; // ha->km2
    }
}
