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

final class Contexts extends Modules\Component\ImetModule
{
    protected $table = 'context_contexts';

    public bool $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_LOW;

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'ACCORDION';
        $this->module_code = 'CTX 1.6';
        $this->module_title = trans('imet-core::v1_context.Contexts.title');
        $this->module_fields = [
            ['name' => 'Context',  'type' => 'disabled',   'label' => trans('imet-core::v1_context.Contexts.fields.Context')],
            ['name' => 'file',  'type' => 'upload',   'label' => trans('imet-core::v1_context.Contexts.fields.file')],
            ['name' => 'Summary',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.Contexts.fields.Summary')],
            ['name' => 'Source',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.Contexts.fields.Source')],
            ['name' => 'Observations',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.Contexts.fields.Observations')],
        ];

        $this->predefined_values = [
            'field' => 'Context',
            'values' => trans('imet-core::v1_context.Contexts.predefined_values'),
        ];

        $this->module_info = trans('imet-core::v1_context.Contexts.module_info');

        parent::__construct($attributes);
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'Contexts',
            'fields' => [
                'Context', 'file', 'Summary', 'Source', 'Observations',
            ],
        ];
    }
}
