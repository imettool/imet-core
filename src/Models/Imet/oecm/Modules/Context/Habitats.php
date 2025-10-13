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

namespace ImetCore\Models\Imet\oecm\Modules\Context;

use Exception;
use ImetCore\Models\Imet\oecm\Modules;
use ImetCore\Models\User\Role;
use ModularForms\Helpers\Input\SelectionList;

class Habitats extends Modules\Component\ImetModule
{
    protected $table = 'context_habitats';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCIES = [
        [Modules\Evaluation\ThreatsBiodiversity::class, 'EcosystemType'],
        [Modules\Evaluation\KeyElementsImpact::class, 'EcosystemType'],
        [Modules\Evaluation\KeyElements::class, 'EcosystemType'],
    ];

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 4.3';
        $this->module_title = trans('imet-core::oecm_context.Habitats.title');
        $this->module_fields = [
            ['name' => 'EcosystemType', 'type' => 'dropdown-ImetOECM_Habitats',   'label' => trans('imet-core::oecm_context.Habitats.fields.EcosystemType')],
            ['name' => 'EcosystemDescription', 'type' => 'text-area',   'label' => trans('imet-core::oecm_context.Habitats.fields.EcosystemDescription')],
            ['name' => 'ExploitedSpecies', 'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.Habitats.fields.ExploitedSpecies')],
            ['name' => 'ProtectedSpecies', 'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.Habitats.fields.ProtectedSpecies')],
            ['name' => 'DisappearingSpecies', 'type' => 'checkbox-boolean', 'label' => trans('imet-core::oecm_context.Habitats.fields.DisappearingSpecies')],
            ['name' => 'PopulationEstimation', 'type' => 'dropdown-ImetOECM_PopulationStatus', 'label' => trans('imet-core::oecm_context.Habitats.fields.PopulationEstimation')],
            ['name' => 'DescribeEstimation', 'type' => 'text-area', 'label' => trans('imet-core::oecm_context.Habitats.fields.DescribeEstimation')],
            ['name' => 'Comments', 'type' => 'text-area', 'label' => trans('imet-core::oecm_context.Habitats.fields.Comments')],
        ];

        $this->module_info = trans('imet-core::oecm_context.Habitats.module_info');

        parent::__construct($attributes);
    }

    /**
     * Override: replace values with labels
     *
     * @throws Exception
     */
    protected static function getRecordsToBeDropped($records, $form_id, $dependency_on): array
    {
        // Get list of values (of reference field) from DB and from updated records
        $existing_values = static::getModule($form_id)
            ->pluck('EcosystemDescription', 'EcosystemType')
            ->unique()
            ->toArray();
        $updated_values = collect($records)
            ->pluck('EcosystemDescription', 'EcosystemType')
            ->unique()
            ->toArray();
        $to_be_dropped = array_diff($existing_values, $updated_values);

        // ### replace values with labels ###
        $labels = SelectionList::getList('ImetOECM_Habitats');
        $to_be_dropped_new = [];
        foreach ($to_be_dropped as $type => $description) {
            if (array_key_exists($type, $labels)) {
                $to_be_dropped_new[] = blank($description)
                    ? $labels[$type]
                    : $labels[$type].' - '.$description;
            }

        }

        return array_values($to_be_dropped_new);
    }

    /**
     * Override: replace values with habitat + description
     */
    public static function getReferenceList($form_id, $dependency_field): array
    {
        return static::getModule($form_id)
            ->filter(function ($item) {
                return filled($item['EcosystemType']);
            })
            ->map(function ($item) {
                $labels = SelectionList::getList('ImetOECM_Habitats');
                $item['EcosystemType'] = $labels[$item['EcosystemType']] ?? null;

                return blank($item['EcosystemDescription'])
                    ? $item['EcosystemType']
                    : $item['EcosystemType'].' - '.$item['EcosystemDescription'];
            })
            ->all();
    }
}
