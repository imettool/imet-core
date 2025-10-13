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

class FinancialResourcesPartners extends Modules\Component\ImetModule
{
    protected $table = 'context_financial_resources_partners';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 3.2.4';
        $this->module_title = trans('imet-core::v1_context.FinancialResourcesPartners.title');
        $this->module_fields = [
            ['name' => 'Partner',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.FinancialResourcesPartners.fields.Partner')],
            ['name' => 'Funding',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.FinancialResourcesPartners.fields.Funding')],
            ['name' => 'Contribution',  'type' => 'integer',   'label' => trans('imet-core::v1_context.FinancialResourcesPartners.fields.Contribution')],
            ['name' => 'StartDate',  'type' => 'date',   'label' => trans('imet-core::v1_context.FinancialResourcesPartners.fields.StartDate')],
            ['name' => 'EndDate',  'type' => 'date',   'label' => trans('imet-core::v1_context.FinancialResourcesPartners.fields.EndDate')],
            ['name' => 'Observations',  'type' => 'text-area',   'label' => trans('imet-core::v1_context.FinancialResourcesPartners.fields.Observations')],
        ];

        $this->module_common_fields = [
            ['name' => 'Currency',  'type' => 'dropdown-ImetV1_Currency',   'label' => trans('imet-core::v1_context.FinancialResourcesPartners.fields.Currency')],
        ];

        parent::__construct($attributes);
    }

    /**
     * Set parameter required to convert OLD SQLite IMETs
     */
    protected static function conversionParameters(): array
    {
        return [
            'table' => 'FinancialResourcesPartners',
            'fields' => [
                'Partner', 'Funding', 'Contribution', 'StartDate', 'EndDate', 'Observations', 'Currency',
            ],
        ];
    }
}
