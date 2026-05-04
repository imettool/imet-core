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
use ModularForms\Enums\ModuleTypes;

final class ManagementStaff extends Modules\Component\ImetModule
{
    protected $table = 'context_management_staff';

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::oecm.context.edit.modules.management_staff';

    public const string BODY_SHOW_BLADE_VIEW = 'imet-core::oecm.context.show.modules.management_staff';

    protected static $DEPENDENCIES = [
        [Modules\Evaluation\StaffCompetence::class, 'Function'],
        [Modules\Evaluation\CapacityAdequacy::class, 'Function'],
    ];

    public function __construct(array $attributes = [])
    {

        $this->module_type = ModuleTypes::TABLE;
        $this->module_code = 'CTX 3.1.2';
        $this->module_title = trans('imet-core::oecm_context.ManagementStaff.title');
        $this->module_fields = [
            ['name' => 'Function',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.ManagementStaff.fields.Function')],
            ['name' => 'Number',  'type' => 'integer',   'label' => trans('imet-core::oecm_context.ManagementStaff.fields.Number')],
            ['name' => 'Male',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.ManagementStaff.fields.Male')],
            ['name' => 'Female',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.ManagementStaff.fields.Female')],
            ['name' => 'Descriptions',  'type' => 'text-area',   'label' => trans('imet-core::oecm_context.ManagementStaff.fields.Descriptions')],
            ['name' => 'AdequateNumber',  'type' => 'integer',   'label' => trans('imet-core::oecm_context.ManagementStaff.fields.AdequateNumber')],
        ];

        $this->module_info = trans('imet-core::oecm_context.ManagementStaff.module_info');

        parent::__construct($attributes);
    }

    /**
     * Calculate weights
     */
    public static function calculateWeights(?int $form_id): array
    {
        $records = self::getModuleRecords($form_id)['records'];

        return collect($records)
            ->map(function (array $item): array {
                $item['__weight'] = round(sqrt($item['Number']), 2);

                return $item;
            })
            ->pluck('__weight', 'Function')
            ->toArray();
    }
}
