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

namespace ImetCore\Models\Imet\v2\Modules\Context;

use Illuminate\Database\Eloquent\Collection;
use ImetCore\Models\Imet\v2\Modules;
use ImetCore\Models\User\Role;
use ModularForms\Models\Module;

/**
 * @property string $Currency
 */
final class FinancialAvailableResources extends Modules\Component\ImetModule
{
    protected $table = 'context_financial_available_resources';

    protected bool $fixed_rows = true;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = [])
    {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 3.2.2';
        $this->module_title = trans('imet-core::v2_context.FinancialAvailableResources.title');
        $this->module_fields = [
            ['name' => 'BudgetType',        'type' => 'disabled',   'label' => trans('imet-core::v2_context.FinancialAvailableResources.fields.BudgetType')],
            ['name' => 'NationalBudget',    'type' => 'integer',   'label' => trans('imet-core::v2_context.FinancialAvailableResources.fields.NationalBudget')],
            ['name' => 'OwnRevenues',       'type' => 'integer',   'label' => trans('imet-core::v2_context.FinancialAvailableResources.fields.OwnRevenues')],
            ['name' => 'Disputes',          'type' => 'integer',   'label' => trans('imet-core::v2_context.FinancialAvailableResources.fields.Disputes')],
            ['name' => 'Partners',          'type' => 'integer',   'label' => trans('imet-core::v2_context.FinancialAvailableResources.fields.Partners')],
        ];

        $this->module_info = trans('imet-core::v2_context.FinancialAvailableResources.module_info');

        $this->predefined_values = [
            'field' => 'BudgetType',
            'values' => trans('imet-core::v2_context.FinancialAvailableResources.predefined_values'),
        ];

        $this->module_common_fields = [
            ['name' => 'Currency', 'type' => 'disabled', 'label' => trans('imet-core::v2_context.FinancialResources.fields.Currency')],
        ];

        parent::__construct($attributes);
    }

    /**
     * Override: force Currency from CTX 3.2.1
     */
    #[\Override]
    public static function getModule(?int $form_id = null): Collection
    {
        return parent::getModule($form_id)
            ->map(
                function (self $item) use ($form_id): Module {
                    $item->Currency ??= FinancialResources::getCurrency($form_id);

                    return $item;
                }
            );
    }

    /**
     * Copy currency from CTX 3.2.1
     */
    public static function copyCurrencyFromCTX213(array $data): array
    {
        if (filled($data['FinancialResources'])) {
            $currency = $data['FinancialResources'][0]['Currency'];
            if ($currency !== null) {
                foreach ($data[self::getShortClassName()] as $i => $record) {
                    $data[self::getShortClassName()][$i]['Currency'] = $currency;
                }
            }
        }

        return $data;
    }
}
