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

final class ManagementStaff extends Modules\Component\ImetModule
{
    protected $table = 'context_management_staff';

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::v1.context.edit.modules.management_staff';

    public const string BODY_SHOW_BLADE_VIEW = 'imet-core::v1.context.show.modules.management_staff';

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 3.1.1';
        $this->module_title = trans('imet-core::v1_context.ManagementStaff.title');
        $this->module_fields = [
            ['name' => 'Function',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.ManagementStaff.fields.Function')],
            ['name' => 'ExpectedPermanent',  'type' => 'integer',   'label' => trans('imet-core::v1_context.ManagementStaff.fields.ExpectedPermanent')],
            ['name' => 'ActualPermanent',  'type' => 'integer',   'label' => trans('imet-core::v1_context.ManagementStaff.fields.ActualPermanent')],
            ['name' => 'Observations',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.ManagementStaff.fields.Observations')],
        ];

        $this->module_common_fields = [
            ['name' => 'Source',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.ManagementStaff.fields.Source')],
        ];

        $this->max_rows = 14;

        $this->module_info = trans('imet-core::v1_context.ManagementStaff.module_info');

        parent::__construct($attributes);
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'ManagementStaff',
            'fields' => [
                'Function',  'ExpectedPermanent', 'ActualPermanent', 'Observations', 'Source',
            ],
        ];
    }

    #[\Override]
    public static function upgradeModule($record, $imet_version = null): array
    {
        // Fix wrong value found in few assessments
        if ($record['Function'] === 'Responsable ErE') {
            $record['Function'] = 'Responsable EE';
        }

        return $record;
    }

    public static function diffs($records): array
    {
        $diffs = [];
        foreach ($records as $index => $item) {
            $diffs[$index] = null;
            if ($item['ExpectedPermanent'] !== null && $item['ActualPermanent']) {
                $diffs[$index] += (int) ($item['ActualPermanent']) - (int) ($item['ExpectedPermanent']);
            }
        }

        return $diffs;
    }
}
