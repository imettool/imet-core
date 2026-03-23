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

use ImetCore\Models\Imet\ImetV2\Modules;
use ImetCore\Models\Species;
use ImetCore\Models\User\Role;

final class AnimalSpecies extends Modules\Component\ImetModule
{
    protected $table = 'context_species_animal_presence';

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCIES = [
        [Modules\Evaluation\ImportanceSpecies::class, 'species'],
        [Modules\Evaluation\InformationAvailability::class, 'species'],
        [Modules\Evaluation\KeyConservationTrend::class, 'species'],
        [Modules\Evaluation\ManagementActivities::class, 'species'],
    ];

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 4.1';
        $this->module_title = trans('imet-core::v2_context.AnimalSpecies.title');
        $this->module_fields = [
            ['name' => 'species',                   'type' => 'imet-core::selector-species-withInsert',   'label' => trans('imet-core::v2_context.AnimalSpecies.fields.SpeciesID')],
            ['name' => 'CommonName',                'type' => 'text-area',          'label' => trans('imet-core::v2_context.AnimalSpecies.fields.CommonName')],
            ['name' => 'FlagshipSpecies',           'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_context.AnimalSpecies.fields.FlagshipSpecies')],
            ['name' => 'EndangeredSpecies',         'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_context.AnimalSpecies.fields.EndangeredSpecies')],
            ['name' => 'EndemicSpecies',            'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_context.AnimalSpecies.fields.EndemicSpecies')],
            ['name' => 'ExploitedSpecies',          'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_context.AnimalSpecies.fields.ExploitedSpecies')],
            ['name' => 'InvasiveSpecies',           'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_context.AnimalSpecies.fields.InvasiveSpecies')],
            ['name' => 'InsufficientDataSpecies',   'type' => 'checkbox-boolean',   'label' => trans('imet-core::v2_context.AnimalSpecies.fields.InsufficientDataSpecies')],
            ['name' => 'PopulationEstimation',      'type' => 'numeric',            'label' => trans('imet-core::v2_context.AnimalSpecies.fields.PopulationEstimation')],
            ['name' => 'DesiredPopulation',         'type' => 'numeric',            'label' => trans('imet-core::v2_context.AnimalSpecies.fields.DesiredPopulation')],
            ['name' => 'Comments',                  'type' => 'text-area',           'label' => trans('imet-core::v2_context.AnimalSpecies.fields.Comments')],
        ];

        $this->module_info = trans('imet-core::v2_context.AnimalSpecies.module_info');

        parent::__construct($attributes);
    }

    #[\Override]
    protected function customValue(array $record, array $field): string|array|null
    {
        $value = $record[$field['name']] ?? null;
        if ($value && Species::isTaxonomy($value)) {
            $taxonomy = Species::parseTaxonomy($value);

            return $taxonomy['genus'].' '.$taxonomy['species'];
        }

        return $value;
    }
}
