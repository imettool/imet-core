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
use ImetCore\Models\Imet\ImetV2\Modules\Evaluation\EquipmentMaintenance;
use ImetCore\Models\Imet\ImetV2\Modules\Evaluation\ManagementEquipmentAdequacy;
use ImetCore\Models\User\Role;
use ModularForms\Enums\ModuleTypes;
use Override;

final class Equipments extends Modules\Component\ImetModule
{
    protected $table = 'context_equipments';

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::v2.context.edit.modules.equipments';

    public const string BODY_SHOW_BLADE_VIEW = 'imet-core::v2.context.show.modules.equipments';

    public function __construct(array $attributes = [])
    {

        $this->module_type = ModuleTypes::GROUP_TABLE;
        $this->module_code = 'CTX 3.3';
        $this->module_title = trans('imet-core::v2_context.Equipments.title');
        $this->module_fields = [
            ['name' => 'Resource',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Equipments.fields.Resource')],
            ['name' => 'AdequacyLevel',  'type' => 'rating-0to3',   'label' => trans('imet-core::v2_context.Equipments.fields.AdequacyLevel')],
            ['name' => 'Comments',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Equipments.fields.Comments')],
        ];

        $this->predefined_values = [
            'field' => 'Resource',
            'values' => [
                'group0' => trans('imet-core::v2_context.Equipments.predefined_values.group0'),
                'group1' => trans('imet-core::v2_context.Equipments.predefined_values.group1'),
                'group2' => trans('imet-core::v2_context.Equipments.predefined_values.group2'),
                'group3' => trans('imet-core::v2_context.Equipments.predefined_values.group3'),
                'group4' => trans('imet-core::v2_context.Equipments.predefined_values.group4'),
                'group5' => trans('imet-core::v2_context.Equipments.predefined_values.group5'),
                'group6' => trans('imet-core::v2_context.Equipments.predefined_values.group6'),
                'group7' => trans('imet-core::v2_context.Equipments.predefined_values.group7'),
                'group8' => trans('imet-core::v2_context.Equipments.predefined_values.group8'),
                'group9' => trans('imet-core::v2_context.Equipments.predefined_values.group9'),
                'group10' => trans('imet-core::v2_context.Equipments.predefined_values.group10'),
                'group11' => trans('imet-core::v2_context.Equipments.predefined_values.group11'),
                'group12' => trans('imet-core::v2_context.Equipments.predefined_values.group12'),
            ],
        ];

        $this->module_groups = [
            'group0' => trans('imet-core::v2_context.Equipments.groups.group0'),
            'group1' => trans('imet-core::v2_context.Equipments.groups.group1'),
            'group2' => trans('imet-core::v2_context.Equipments.groups.group2'),
            'group3' => trans('imet-core::v2_context.Equipments.groups.group3'),
            'group4' => trans('imet-core::v2_context.Equipments.groups.group4'),
            'group5' => trans('imet-core::v2_context.Equipments.groups.group5'),
            'group6' => trans('imet-core::v2_context.Equipments.groups.group6'),
            'group7' => trans('imet-core::v2_context.Equipments.groups.group7'),
            'group8' => trans('imet-core::v2_context.Equipments.groups.group8'),
            'group9' => trans('imet-core::v2_context.Equipments.groups.group9'),
            'group10' => trans('imet-core::v2_context.Equipments.groups.group10'),
            'group11' => trans('imet-core::v2_context.Equipments.groups.group11'),
            'group12' => trans('imet-core::v2_context.Equipments.groups.group12'),
        ];

        $this->ratingLegend = trans('imet-core::v2_context.Equipments.ratingLegend');

        parent::__construct($attributes);

    }

    #[Override]
    public static function updateModuleRecords(array $records, ?int $form_id): void
    {
        parent::updateModuleRecords($records, $form_id);
        EquipmentMaintenance::refreshRecords($form_id);
        ManagementEquipmentAdequacy::refreshRecords($form_id);
    }

    /**
     * Override
     */
    #[Override]
    public static function upgradeModule($record, $imet_version = null): array
    {
        // ####  v2.0 -> v2.0b  ####
        $record = self::replacePredefinedValue($record, 'Resource', 'Hydraulic electric facility', 'Hydropower electric facility');

        return $record;
    }
}
