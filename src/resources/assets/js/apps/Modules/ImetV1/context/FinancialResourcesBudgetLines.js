/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

import ModuleImet from "../../../Module.js";

import { ref, computed } from "vue";

export default class FinancialResourcesBudgetLines extends ModuleImet {

    constructor(input_data = {}) {

        const custom_props = {
            area: {
                type: Number,
                default: input_data.area
            }
        };

        return super(input_data, custom_props);
    }

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        const costs = computed(() => {
            let result = [];
            setup_obj.records.forEach(function (item, index) {
                result[index] = 0;
                if(props.area!==null && props.area>0){
                    result[index] = item['Amount'] / props.area * 100;
                }
                result[index] = result[index]===0 ? null : result[index].toFixed(2);
            });
            return result;
        });

        const percentages = computed(() => {
            let result = [];
            let totalBudget = get_total_budget();
            setup_obj.records.forEach(function (item, index) {
                let cost =  parseFloat(costs.value[index]);
                result[index] = '';
                if(cost>0 && totalBudget > 0){
                    result[index] = (cost/totalBudget*100).toFixed(1) + ' %';
                }
            });
            return result;
        });

        const sumBudget = computed(() => {
            return setup_obj.sumColumnFloat('Amount');
        });

        function get_total_budget(){
            return window.imet__v1__context__financial_available_resources.totals.reduce(
                (accumulator, currentValue) => accumulator + currentValue
            );
        }

        return {
            ...setup_obj,
            costs,
            percentages,
            sumBudget
        };

    }

}