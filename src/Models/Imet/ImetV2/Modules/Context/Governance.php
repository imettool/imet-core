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

use Exception;
use ImetCore\Models\Imet\ImetV2\Modules;
use ImetCore\Models\User\Role;

final class Governance extends Modules\Component\ImetModule
{
    protected $table = 'context_governance';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;
    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::v2.context.edit.modules.governance';
    public const string BODY_SHOW_BLADE_VIEW = 'imet-core::v2.context.show.modules.governance';

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'ACCORDION';
        $this->module_code = 'CTX 1.2';
        $this->module_title = trans('imet-core::v2_context.Governance.title');
        $this->module_fields = [
            ['name' => 'Partner',               'type' => 'text-area',         'label' => trans('imet-core::v2_context.Governance.fields.Partner'),            'other' => 'style="width:200px"'],
            ['name' => 'InstitutionType',       'type' => 'dropdown-ImetV2_InstitutionType',      'label' => trans('imet-core::v2_context.Governance.fields.InstitutionType'),    'other' => 'style="width:205px"'],
            ['name' => 'PartnershipsType1',     'type' => 'dropdown-ImetV2_PartnershipsType',     'label' => trans('imet-core::v2_context.Governance.fields.PartnershipsType1'),  'other' => 'style="width:205px"'],
            ['name' => 'PartnershipsType2',     'type' => 'dropdown-ImetV2_PartnershipsType',     'label' => trans('imet-core::v2_context.Governance.fields.PartnershipsType2'),  'other' => 'style="width:205px"'],
            ['name' => 'PartnershipsType3',     'type' => 'dropdown-ImetV2_PartnershipsType',     'label' => trans('imet-core::v2_context.Governance.fields.PartnershipsType3'),  'other' => 'style="width:205px"'],
        ];

        $this->module_common_fields = [
            ['name' => 'GovernanceModel',      'type' => 'dropdown-ImetV2_GovernanceModel',   'label' => trans('imet-core::v2_context.Governance.fields.GovernanceModel')],
            ['name' => 'SubGovernanceModel',   'type' => 'blade-imet-core::v2.context.fields.SubGovernanceModel',   'label' => trans('imet-core::v2_context.Governance.fields.SubGovernanceModel')],
            ['name' => 'AdditionalInfo',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.Governance.fields.AdditionalInfo')],
        ];

        $this->module_info = trans('imet-core::v2_context.Governance.module_info');

        parent::__construct($attributes);
    }

    /**
     * @throws Exception
     */
    public static function upgradeModule($record, $imet_version = null): array
    {
        // #### not in predefined lists ####
        $record['InstitutionType'] = self::dropIfValueNotInPredefinedList($record['InstitutionType'], 'InstitutionType');
        $record['PartnershipsType1'] = self::dropIfValueNotInPredefinedList($record['PartnershipsType1'], 'PartnershipsType');
        $record['PartnershipsType2'] = self::dropIfValueNotInPredefinedList($record['PartnershipsType2'], 'PartnershipsType');
        $record['PartnershipsType3'] = self::dropIfValueNotInPredefinedList($record['PartnershipsType3'], 'PartnershipsType');
        if (array_key_exists('Type', $record)) {
            $record['Type'] = self::dropIfValueNotInPredefinedList($record['Type'], 'GovernanceType'); // until v2.13.7
        } elseif (array_key_exists('GovernanceType', $record)) {
            $record['GovernanceModel'] = self::dropIfValueNotInPredefinedList($record['GovernanceModel'], 'GovernanceType'); // after v3.*
        }

        // ####  v2.13.7 -> v3.*  ####
        $record = self::renameField($record, 'Type', 'GovernanceModel');

        return self::renameField($record, 'Comments', 'AdditionalInfo');
    }
}
