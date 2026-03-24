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

use ImetCore\Models\Imet\ImetOecm\Modules;
use ImetCore\Models\User\Role;

final class Equipments extends Modules\Component\ImetModule
{
    protected $table = 'context_equipments';

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    protected static $DEPENDENCIES = [
        [Modules\Evaluation\EquipmentMaintenance::class, 'Resource'],
        [Modules\Evaluation\ManagementEquipmentAdequacy::class, 'Resource'],
    ];

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'GROUP_TABLE';
        $this->module_code = 'CTX 3.3';
        $this->module_title = trans('imet-core::oecm_context.Equipments.title');
        $this->module_fields = [
            ['name' => 'Resource',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.Equipments.fields.Resource')],
            ['name' => 'AdequacyLevel',  'type' => 'rating-0to3',   'label' => trans('imet-core::oecm_context.Equipments.fields.AdequacyLevel')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.Equipments.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Resource',
            'values' => [
                'group0' => trans('imet-core::oecm_context.Equipments.predefined_values.group0'),
                'group1' => trans('imet-core::oecm_context.Equipments.predefined_values.group1'),
                'group2' => trans('imet-core::oecm_context.Equipments.predefined_values.group2'),
                'group3' => trans('imet-core::oecm_context.Equipments.predefined_values.group3'),
                'group4' => trans('imet-core::oecm_context.Equipments.predefined_values.group4'),
                'group5' => trans('imet-core::oecm_context.Equipments.predefined_values.group5'),
                'group6' => trans('imet-core::oecm_context.Equipments.predefined_values.group6'),
                'group7' => trans('imet-core::oecm_context.Equipments.predefined_values.group7'),
                'group8' => trans('imet-core::oecm_context.Equipments.predefined_values.group8'),
                'group9' => trans('imet-core::oecm_context.Equipments.predefined_values.group9'),
            ],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::oecm_context.Equipments.groups.group0'),
            'group1' => trans('imet-core::oecm_context.Equipments.groups.group1'),
            'group2' => trans('imet-core::oecm_context.Equipments.groups.group2'),
            'group3' => trans('imet-core::oecm_context.Equipments.groups.group3'),
            'group4' => trans('imet-core::oecm_context.Equipments.groups.group4'),
            'group5' => trans('imet-core::oecm_context.Equipments.groups.group5'),
            'group6' => trans('imet-core::oecm_context.Equipments.groups.group6'),
            'group7' => trans('imet-core::oecm_context.Equipments.groups.group7'),
            'group8' => trans('imet-core::oecm_context.Equipments.groups.group8'),
            'group9' => trans('imet-core::oecm_context.Equipments.groups.group9'),
        ];

        $this->ratingLegend = trans('imet-core::oecm_context.Equipments.ratingLegend');

        parent::__construct($attributes);
    }

    #[\Override]
    protected static function getRecordsToBeDropped($records, $form_id, $dependency_on): array
    {
        // Get list of values (of reference field) from DB and from updated records
        $existing_values = self::getModule($form_id)
            ->whereNotNull('AdequacyLevel')
            ->pluck('group_key')->unique()->toArray();
        $updated_values = collect($records)
            ->whereNotNull('AdequacyLevel')
            ->pluck('group_key')->unique()->toArray();

        // Make diff to find out what to drop
        $to_be_dropped = array_diff($existing_values, $updated_values);

        return array_values($to_be_dropped);
    }
}
