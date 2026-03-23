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

final class Governance extends Modules\Component\ImetModule
{
    protected $table = 'context_governance';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'ACCORDION';
        $this->module_code = 'CTX 1.2';
        $this->module_title = trans('imet-core::v1_context.Governance.title');
        $this->module_fields = [
            ['name' => 'Partner',               'type' => 'text-area',         'label' => trans('imet-core::v1_context.Governance.fields.Partner'),            'other' => 'style="width:200px"'],
            ['name' => 'InstitutionType',       'type' => 'dropdown-ImetV1_InstitutionType',      'label' => trans('imet-core::v1_context.Governance.fields.InstitutionType'),    'other' => 'style="width:205px"'],
            ['name' => 'PartnershipsType1',     'type' => 'dropdown-ImetV1_PartnershipsType',     'label' => trans('imet-core::v1_context.Governance.fields.PartnershipsType1'),  'other' => 'style="width:205px"'],
            ['name' => 'PartnershipsType2',     'type' => 'dropdown-ImetV1_PartnershipsType',     'label' => trans('imet-core::v1_context.Governance.fields.PartnershipsType2'),  'other' => 'style="width:205px"'],
            ['name' => 'PartnershipsType3',     'type' => 'dropdown-ImetV1_PartnershipsType',     'label' => trans('imet-core::v1_context.Governance.fields.PartnershipsType3'),  'other' => 'style="width:205px"'],
        ];

        $this->module_common_fields = [
            ['name' => 'GovernanceModel',      'type' => 'dropdown-ImetV1_GovernanceType',   'label' => trans('imet-core::v1_context.Governance.fields.Type')],
            ['name' => 'AdditionalInfo',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.Governance.fields.Comments')],
        ];

        parent::__construct($attributes);
    }

    public static function upgradeModule($record, $imet_version = null): array
    {
        // Rename fields to match the new DB column names
        $record = self::renameField($record, 'Type', 'GovernanceModel');

        return self::renameField($record, 'Comments', 'AdditionalInfo');
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'Governance',
            'fields' => [
                'Partner', 'InstitutionType', 'PartnershipsType1', 'PartnershipsType2', 'PartnershipsType3', 'Type', 'Comments',
            ],
        ];
    }
}
