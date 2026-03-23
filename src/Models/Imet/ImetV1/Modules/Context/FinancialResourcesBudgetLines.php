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

final class FinancialResourcesBudgetLines extends Modules\Component\ImetModule
{
    protected $table = 'context_financial_resources_budget_lines';

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::v1.context.edit.modules.financial_resources_budget_lines';
    public const string BODY_SHOW_BLADE_VIEW = 'imet-core::v1.context.show.modules.financial_resources_budget_lines';

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 3.2.3';
        $this->module_title = trans('imet-core::v1_context.FinancialResourcesBudgetLines.title');
        $this->module_fields = [
            ['name' => 'Line',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.FinancialResourcesBudgetLines.fields.Line')],
            ['name' => 'Amount',  'type' => 'integer',   'label' => trans('imet-core::v1_context.FinancialResourcesBudgetLines.fields.Amount')],
            ['name' => 'BudgetSource',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.FinancialResourcesBudgetLines.fields.BudgetSource')],
        ];

        $this->module_common_fields = [
            ['name' => 'Currency',  'type' => 'dropdown-ImetV1_Currency',   'label' => trans('imet-core::v1_context.FinancialResourcesBudgetLines.fields.Currency')],
        ];

        parent::__construct($attributes);
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'FinancialResourcesBudgetLines',
            'fields' => [
                'Line', 'Amount', 'BudgetSource', 'Currency',
            ],
        ];
    }
}
