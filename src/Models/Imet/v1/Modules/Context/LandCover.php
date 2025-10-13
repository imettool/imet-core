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

class LandCover extends Modules\Component\ImetModule
{
    protected $table = 'context_land_cover';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 4.4';
        $this->module_title = trans('imet-core::v1_context.LandCover.title');
        $this->module_fields = [
            ['name' => 'CoverType',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.LandCover.fields.CoverType')],
            ['name' => 'HistoricalArea',  'type' => 'integer',   'label' => trans('imet-core::v1_context.LandCover.fields.HistoricalArea')],
            ['name' => 'PreviousEstimationArea',  'type' => 'integer',   'label' => trans('imet-core::v1_context.LandCover.fields.PreviousEstimationArea')],
            ['name' => 'CurrentEstimationArea',  'type' => 'integer',   'label' => trans('imet-core::v1_context.LandCover.fields.CurrentEstimationArea')],
            ['name' => 'Trend',  'type' => 'rating-Minus2to2',   'label' => trans('imet-core::v1_context.LandCover.fields.Trend')],
            ['name' => 'Reliability',  'type' => 'dropdown-ImetV1_SpeciesReliability',   'label' => trans('imet-core::v1_context.LandCover.fields.Reliability'), 'class' => 'width100px'],
            ['name' => 'Notes',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.LandCover.fields.Notes')],
        ];

        $this->module_common_fields = [
            ['name' => 'HistoricalAreaData',  'type' => 'date',   'label' => trans('imet-core::v1_context.LandCover.fields.HistoricalAreaData')],
            ['name' => 'PreviousEstimationAreaData',  'type' => 'date',   'label' => trans('imet-core::v1_context.LandCover.fields.PreviousEstimationAreaData')],
        ];

        $this->predefined_values = [
            'field' => 'CoverType',
            'values' => trans('imet-core::v1_context.LandCover.predefined_values'),
        ];

        $this->module_info = trans('imet-core::v1_context.LandCover.module_info');
        $this->ratingLegend = trans('imet-core::v1_context.LandCover.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'LandCover',
            'fields' => [
                'CoverType',
                'HistoricalArea',
                'PreviousEstimationArea',
                'CurrentEstimationArea',
                'Trend',
                'Reliability',
                'Notes',
                'HistoricalAreaData',
                'PreviousEstimationAreaData',
            ],
        ];
    }
}
