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
use ImetCore\Models\User\Role;
use ModularForms\Enums\ModuleTypes;

final class FinancialResources extends Modules\Component\ImetModule
{
    protected $table = 'context_financial_resources';

    public const int REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public const string BODY_EDIT_BLADE_VIEW = 'imet-core::v2.context.edit.modules.financial_resources';

    public const string BODY_SHOW_BLADE_VIEW = 'imet-core::v2.context.show.modules.financial_resources';

    public function __construct(array $attributes = [])
    {
        $this->module_type = ModuleTypes::SIMPLE;
        $this->module_code = 'CTX 3.2.1';
        $this->module_title = trans('imet-core::v2_context.FinancialResources.title');
        $this->module_fields = [
            [
                'name' => 'Currency',
                'type' => 'currency-unit-minimal',
                'label' => trans('imet-core::v2_context.FinancialResources.fields.Currency'),
            ],
            [
                'name' => 'ReferenceYear',
                'type' => 'integer',
                'label' => trans('imet-core::v2_context.FinancialResources.fields.ReferenceYear'),
            ],
            [
                'name' => 'ManagementFinancialPlanCosts',
                'type' => 'currency',
                'label' => trans('imet-core::v2_context.FinancialResources.fields.ManagementFinancialPlanCosts'),
            ],
            [
                'name' => 'OperationalWorkPlanCosts',
                'type' => 'currency',
                'label' => trans('imet-core::v2_context.FinancialResources.fields.OperationalWorkPlanCosts'),
            ],
            [
                'name' => 'TotalBudget',
                'type' => 'currency',
                'label' => trans('imet-core::v2_context.FinancialResources.fields.TotalBudget'),
            ],
        ];

        $this->module_info = trans('imet-core::v2_context.FinancialResources.module_info');

        parent::__construct($attributes);
    }

    public static function getCurrency(?int $form_id)
    {
        return self::getModule($form_id)->first()
            ->Currency ?? null;
    }

    public static function getTotalBudget(?int $form_id)
    {
        $records = self::getModuleRecords($form_id)['records'];

        return $records[0]['TotalBudget'];
    }
}
