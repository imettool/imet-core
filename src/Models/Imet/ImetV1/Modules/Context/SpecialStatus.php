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

final class SpecialStatus extends Modules\Component\ImetModule
{
    protected $table = 'context_special_status';

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'GROUP_ACCORDION';
        $this->module_code = 'CTX 1.3';
        $this->module_title = trans('imet-core::v1_context.SpecialStatus.title');
        $this->module_fields = [
            ['name' => 'Designation',           'type' => 'suggestion-ImetV1_Designation',   'label' => trans('imet-core::v1_context.SpecialStatus.fields.Designation')],
            ['name' => 'RegistrationDate',      'type' => 'date',   'label' => trans('imet-core::v1_context.SpecialStatus.fields.RegistrationDate')],
            ['name' => 'Code',                  'type' => 'text-area',   'label' => trans('imet-core::v1_context.SpecialStatus.fields.Code')],
            ['name' => 'Area',                  'type' => 'integer',   'label' => trans('imet-core::v1_context.SpecialStatus.fields.Area')],
            ['name' => 'DesignationCriteria',   'type' => 'text-area',   'label' => trans('imet-core::v1_context.SpecialStatus.fields.DesignationCriteria')],
            ['name' => 'upload',                'type' => 'upload',   'label' => trans('imet-core::v1_context.SpecialStatus.fields.upload')],
        ];

        $this->module_groups = [
            'conventions' => trans('imet-core::v1_context.SpecialStatus.groups.conventions'),
            'networks' => trans('imet-core::v1_context.SpecialStatus.groups.networks'),
            'conservation' => trans('imet-core::v1_context.SpecialStatus.groups.conservation'),
            'marine_pa' => trans('imet-core::v1_context.SpecialStatus.groups.marine_pa'),
        ];

        $this->module_info = trans('imet-core::v1_context.SpecialStatus.module_info');

        parent::__construct($attributes);
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'SpecialStatus',
            'fields' => [
                'Designation', 'RegistrationDate', 'Code', 'Area', 'DesignationCriteria', 'upload', 'DesignationGroup',
            ],
        ];
    }

    /**
     * Review data from SQLITE
     */
    protected static function conversionDataReview(array $record, $sqlite_connection): array
    {
        return self::convertGroupLabelToKey($record, 'DesignationGroup');
    }
}
