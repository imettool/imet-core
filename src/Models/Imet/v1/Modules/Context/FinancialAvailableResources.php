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

namespace ImetCore\Models\Imet\v1\Modules\Context;

use ImetCore\Models\Imet\v1\Modules;
use ImetCore\Models\User\Role;

class FinancialAvailableResources extends Modules\Component\ImetModule
{
    protected $table = 'context_financial_available_resources';

    protected bool $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 3.2.2';
        $this->module_title = trans('imet-core::v1_context.FinancialAvailableResources.title');
        $this->module_fields = [
            ['name' => 'BudgetType',        'type' => 'text-area',   'label' => trans('imet-core::v1_context.FinancialAvailableResources.fields.BudgetType')],
            ['name' => 'NationalBudget',    'type' => 'integer',   'label' => trans('imet-core::v1_context.FinancialAvailableResources.fields.NationalBudget')],
            ['name' => 'OwnRevenues',       'type' => 'integer',   'label' => trans('imet-core::v1_context.FinancialAvailableResources.fields.OwnRevenues')],
            ['name' => 'Disputes',          'type' => 'integer',   'label' => trans('imet-core::v1_context.FinancialAvailableResources.fields.Disputes')],
            ['name' => 'Partners',          'type' => 'integer',   'label' => trans('imet-core::v1_context.FinancialAvailableResources.fields.Partners')],
        ];

        $this->module_common_fields = [
            ['name' => 'Currency',          'type' => 'dropdown-ImetV1_Currency',   'label' => trans('imet-core::v1_context.FinancialAvailableResources.fields.Currency')],
        ];

        $this->predefined_values = [
            'field' => 'BudgetType',
            'values' => trans('imet-core::v1_context.FinancialAvailableResources.predefined_values'),
        ];

        parent::__construct($attributes);
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'FinancialAvailableResources',
            'fields' => [
                'BudgetType', 'NationalBudget', 'OwnRevenues',  'Disputes', 'Partners', 'Currency',
            ],
        ];
    }
}
