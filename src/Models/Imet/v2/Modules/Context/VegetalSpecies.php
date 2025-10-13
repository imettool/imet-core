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

namespace ImetCore\Models\Imet\v2\Modules\Context;

use ImetCore\Models\Imet\v2\Modules;
use ImetCore\Models\User\Role;

class VegetalSpecies extends Modules\Component\ImetModule
{
    protected $table = 'context_species_vegetal_presence';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCIES = [
        [Modules\Evaluation\ImportanceSpecies::class, 'Species'],
        [Modules\Evaluation\InformationAvailability::class, 'Species'],
        [Modules\Evaluation\KeyConservationTrend::class, 'Species'],
        [Modules\Evaluation\ManagementActivities::class, 'Species'],
    ];

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 4.2';
        $this->module_title = trans('imet-core::v2_context.VegetalSpecies.title');
        $this->module_fields = [
            ['name' => 'Species',                   'type' => 'text-area',               'label' => trans('imet-core::v2_context.VegetalSpecies.fields.Species')],
            ['name' => 'FlagshipSpecies',           'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_context.VegetalSpecies.fields.FlagshipSpecies')],
            ['name' => 'EndangeredSpecies',         'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_context.VegetalSpecies.fields.EndangeredSpecies')],
            ['name' => 'EndemicSpecies',            'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_context.VegetalSpecies.fields.EndemicSpecies')],
            ['name' => 'ExploitedSpecies',          'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_context.VegetalSpecies.fields.ExploitedSpecies')],
            ['name' => 'InvasiveSpecies',           'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_context.VegetalSpecies.fields.InvasiveSpecies')],
            ['name' => 'InsufficientDataSpecies',   'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_context.VegetalSpecies.fields.InsufficientDataSpecies')],
            ['name' => 'PopulationEstimation',      'type' => 'numeric',            'label' => trans('imet-core::v2_context.VegetalSpecies.fields.PopulationEstimation')],
            ['name' => 'DesiredPopulation',         'type' => 'numeric',            'label' => trans('imet-core::v2_context.VegetalSpecies.fields.DesiredPopulation')],
            ['name' => 'Comments',                  'type' => 'text-area',          'label' => trans('imet-core::v2_context.VegetalSpecies.fields.Comments')],
        ];

        $this->module_info = trans('imet-core::v2_context.VegetalSpecies.module_info');

        parent::__construct($attributes);

    }
}
