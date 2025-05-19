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

use ImetCore\Models\Imet\v2\Modules;
use ImetCore\Models\User\Role;

class FinancialResourcesBudgetLines extends Modules\Component\ImetModule
{
    protected $table = 'context_financial_resources_budget_lines';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

    public function __construct(array $attributes = []) {

        $this->module_type = 'TABLE';
        $this->module_code = 'CTX 3.2.3';
        $this->module_title = trans('imet-core::v2_context.FinancialResourcesBudgetLines.title');
        $this->module_fields = [
            ['name' => 'Line',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.FinancialResourcesBudgetLines.fields.Line')],
            ['name' => 'Amount',  'type' => 'integer',   'label' => trans('imet-core::v2_context.FinancialResourcesBudgetLines.fields.Amount')],
            ['name' => 'BudgetSource',  'type' => 'text-area',   'label' => trans('imet-core::v2_context.FinancialResourcesBudgetLines.fields.BudgetSource')],
        ];

        $this->module_info = trans('imet-core::v2_context.FinancialResourcesBudgetLines.module_info');

        $this->module_common_fields = [
            ['name' => 'Currency', 'type' => 'disabled', 'label' => trans('imet-core::v2_context.FinancialResources.fields.Currency')],
        ];

        parent::__construct($attributes);
    }

    /**
     * Override: force Currency from CTX 3.2.1
     *
     * @param null $form_id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public static function getModule($form_id = null)
    {
        return parent::getModule($form_id)
            ->map(
                function ($item) use ($form_id) {
                    $item->Currency = $item->Currency ?? FinancialResources::getCurrency($form_id);
                    return $item;
                }
            );
    }

    public static function copyCurrencyFromCTX213($data)
    {
        if(!empty($data['FinancialResources'])){
            $currency = $data['FinancialResources'][0]['Currency'];
            if($currency!==null){
                foreach ($data[static::getShortClassName()] as $i=>$record){
                    $data[static::getShortClassName()][$i]['Currency'] = $currency;
                }
            }
        }
        return $data;
    }
}
