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

final class AnimalSpecies extends Modules\Component\ImetModule
{
    protected $table = 'context_species_animal_presence';

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = [])
    {

        $this->module_type = ModuleTypes::TABLE;
        $this->module_code = 'CTX 4.1';
        $this->module_title = trans('imet-core::v1_context.AnimalSpecies.title');
        $this->module_fields = [
            ['name' => 'species',                   'type' => 'custom::selector-species',   'label' => trans('imet-core::v1_context.AnimalSpecies.fields.SpeciesID')],
            ['name' => 'CommonName',                'type' => 'text-area',          'label' => trans('imet-core::v1_context.AnimalSpecies.fields.CommonName')],
            ['name' => 'FlagshipSpecies',           'type' => 'checkbox-boolean',   'label' => trans('imet-core::v1_context.AnimalSpecies.fields.FlagshipSpecies')],
            ['name' => 'EndangeredSpecies',         'type' => 'checkbox-boolean',   'label' => trans('imet-core::v1_context.AnimalSpecies.fields.EndangeredSpecies')],
            ['name' => 'EndemicSpecies',            'type' => 'checkbox-boolean',   'label' => trans('imet-core::v1_context.AnimalSpecies.fields.EndemicSpecies')],
            ['name' => 'ExploitedSpecies',          'type' => 'checkbox-boolean',   'label' => trans('imet-core::v1_context.AnimalSpecies.fields.ExploitedSpecies')],
            ['name' => 'InvasiveSpecies',           'type' => 'checkbox-boolean',   'label' => trans('imet-core::v1_context.AnimalSpecies.fields.InvasiveSpecies')],
            ['name' => 'InsufficientDataSpecies',   'type' => 'checkbox-boolean',   'label' => trans('imet-core::v1_context.AnimalSpecies.fields.InsufficientDataSpecies')],
            ['name' => 'PopulationEstimation',      'type' => 'integer',            'label' => trans('imet-core::v1_context.AnimalSpecies.fields.PopulationEstimation')],
            ['name' => 'DesiredPopulation',         'type' => 'integer',            'label' => trans('imet-core::v1_context.AnimalSpecies.fields.DesiredPopulation')],
            ['name' => 'TrendRating',               'type' => 'rating-Minus2to2',   'label' => trans('imet-core::v1_context.AnimalSpecies.fields.TrendRating')],
            ['name' => 'Reliability',               'type' => 'dropdown-ImetV1_SpeciesReliability', 'label' => trans('imet-core::v1_context.AnimalSpecies.fields.Reliability'), 'class' => 'width100px'],
            ['name' => 'Comments',                  'type' => 'text-area',           'label' => trans('imet-core::v1_context.AnimalSpecies.fields.Comments')],
        ];

        $this->module_info = trans('imet-core::v1_context.AnimalSpecies.module_info');
        $this->ratingLegend = trans('imet-core::v1_context.AnimalSpecies.ratingLegend');

        parent::__construct($attributes);
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'SpeciesAnimalPresence',
            'fields' => [
                'SpeciesID',
                'FlagshipSpecies',
                'EndangeredSpecies',
                'EndemicSpecies',
                'ExploitedSpecies',
                'InvasiveSpecies',
                'InsufficientDataSpecies',
                'PopulationEstimation',
                'DesiredPopulation',
                'TrendRating',
                'Reliability',
                'Comments',
            ],
        ];
    }
}
