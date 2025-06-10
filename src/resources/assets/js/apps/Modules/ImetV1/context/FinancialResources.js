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
import selectorWdpa from "../../../../inputs/selector-wdpa.vue";
import scopeIcon from "../../../../templates/scope_icon.vue";

export default class FinancialResources extends ModuleImet {

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

        const functioning_costs_1 = computed(() => {
            let value = setup_obj.records[0]['ManagementFinancialPlanCosts'];
            return calc_ratio(value, props.area);
        });

        const functioning_costs_2 = computed(() => {
            let value = setup_obj.records[0]['OperationalWorkPlanCosts'];
            return calc_ratio(value, props.area);
        });

        const functioning_costs_3 = computed(() => {
            let value = setup_obj.records[0]['TotalBudget'];
            return calc_ratio(value, props.area);
        });

        const estimation_financial_plan_2 = computed(() => {
            let value = setup_obj.records[0]['OperationalWorkPlanCosts'];
            let value2 = setup_obj.records[0]['ManagementFinancialPlanCosts'];
            return calc_percentage(value, value2);
        });

        const estimation_financial_plan_3 = computed(() => {
            let result = null;
            let value = setup_obj.records[0]['TotalBudget'];
            let value2 = setup_obj.records[0]['ManagementFinancialPlanCosts'];
            return calc_percentage(value, value2);
        });

        const estimation_operational_plan_3 = computed(() => {
            let value = setup_obj.records[0]['TotalBudget'];
            let value2 = setup_obj.records[0]['OperationalWorkPlanCosts'];
            return calc_percentage(value, value2);
        });

        function calc_ratio(value, value2){
            if(isValid(value2) && isValid(value) && value>0 && value2>0){
                return (parseFloat(value) / parseFloat(value2)).toFixed(1);
            }
            return null;
        }

        function calc_percentage(value, value2){
            if(isValid(value2) && isValid(value) && value>0 && value2>0){
                return (parseFloat(value) / parseFloat(value2)* 100).toFixed(2);
            }
            return null;
        }

        function isValid(n) {
            return !isNaN(parseFloat(n)) && isFinite(n) && n !== null;
        }


        return {
            ...setup_obj,
            functioning_costs_1,
            functioning_costs_2,
            functioning_costs_3,
            estimation_financial_plan_2,
            estimation_financial_plan_3,
            estimation_operational_plan_3
        };

    }

}