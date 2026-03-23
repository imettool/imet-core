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

use Illuminate\Database\Eloquent\Collection;
use ImetCore\Helpers\Template;
use ImetCore\Models\Imet\ImetV2\Imet;
use ImetCore\Models\Imet\ImetV2\Modules;
use ImetCore\Models\ProtectedArea;
use ImetCore\Models\User\Role;

final class Areas extends Modules\Component\ImetModule
{
    protected $table = 'context_areas';

    public int $label_width = 5;

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::v2.context.edit.modules.areas';
    public const string BODY_SHOW_BLADE_VIEW = 'imet-core::v2.context.show.modules.areas';


    public function __construct(array $attributes = [])
    {
        $this->module_type = 'SIMPLE';
        $this->module_code = 'CTX 2.2';
        $this->module_title = trans('imet-core::v2_context.Areas.title');
        $this->module_fields = [
            [
                'name' => 'AdministrativeArea',
                'type' => 'numeric',
                'label' => trans('imet-core::v2_context.Areas.fields.AdministrativeArea'),
            ],
            [
                'name' => 'WDPAArea',
                'type' => 'numeric',
                'label' => trans('imet-core::v2_context.Areas.fields.WDPAArea')],
            [
                'name' => 'GISArea',
                'type' => 'numeric',
                'label' => trans('imet-core::v2_context.Areas.fields.GISArea'),
            ],
            [
                'name' => 'BoundaryLength',
                'type' => 'numeric',
                'label' => trans('imet-core::v2_context.Areas.fields.BoundaryLength'),
            ],
            [
                'name' => 'TerrestrialArea',
                'type' => 'numeric',
                'label' => Template::module_scope(self::TERRESTRIAL).trans('imet-core::v2_context.Areas.fields.TerrestrialArea'),
            ],
            [
                'name' => 'MarineArea',
                'type' => 'numeric',
                'label' => Template::module_scope(self::MARINE).trans('imet-core::v2_context.Areas.fields.MarineArea'),
            ],
            [
                'name' => 'PercentageNationalNetwork',
                'type' => 'numeric',
                'label' => trans('imet-core::v2_context.Areas.fields.PercentageNationalNetwork'),
            ],
            [
                'name' => 'PercentageEcoregion',
                'type' => 'numeric',
                'label' => trans('imet-core::v2_context.Areas.fields.PercentageEcoregion'),
            ],
            [
                'name' => 'PercentageTransnationalNetwork',
                'type' => 'numeric',
                'label' => trans('imet-core::v2_context.Areas.fields.PercentageTransnationalNetwork'),
            ],
            [
                'name' => 'PercentageLandscapeNetwork',
                'type' => 'numeric',
                'label' => trans('imet-core::v2_context.Areas.fields.PercentageLandscapeNetwork'),
            ],
            [
                'name' => 'Index',
                'type' => 'numeric',
                'label' => trans('imet-core::v2_context.Areas.fields.Index'),
            ],
        ];

        $this->module_common_fields = [
            [
                'name' => 'Observations',
                'type' => 'text-area',
                'label' => trans('imet-core::v2_context.Areas.fields.Observations'),
            ],
        ];

        $this->module_info = trans('imet-core::v2_context.Areas.module_info');

        parent::__construct($attributes);
    }

    public static function getArea(?int $form_id, $in_km2 = true): int|float|null
    {
        $records = self::getModuleRecords($form_id)['records'];
        if(count($records) === 0) {
            return null;
        }

        $record = $records[0];
        foreach (['GISArea', 'WDPAArea', 'AdministrativeArea'] as $area_field) {
            if(array_key_exists($area_field, $record) && $record[$area_field] !== null && $record[$area_field] > 0){
                return $in_km2
                    ? $record[$area_field] / 100  // ha->km2
                    : $record[$area_field];
            }
        }

        return null;
    }

    public static function getShapeIndex($area, $boundary_length): float|null
    {
        return floatval($area)>0 && floatval($boundary_length)>0
            ? round(sqrt(3.14)/(2*3.14)*floatval($boundary_length)/sqrt($area), 2)
            : null;
    }

    /**
     * Override: retrieve the PA area (only when the module is empty)
     */
    #[\Override]
    public static function getModuleRecords(?int $form_id, ?Collection $collection = null): array
    {
        $records = parent::getModuleRecords($form_id, $collection);

        if ($records['records'][0] === $records['empty_record']) {
            $wdpa = Imet::query()->find($form_id);
            if (! $wdpa || ! $wdpa->wdpa_id) {
                return $records;
            }

            $wdpa_id = $wdpa->wdpa_id;
            $pa_area_km2 = ProtectedArea::getByWdpa($wdpa_id)->area;
            if ($pa_area_km2 !== null && $pa_area_km2 > 0) {
                $pa_area_ha = $pa_area_km2 * 100; // km2 -> ha
                $records['empty_record']['WDPAArea'] = $pa_area_ha;
                $records['records'][0] = $records['empty_record'];
            }
        }

        return $records;
    }
}
