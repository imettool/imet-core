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

export default class FinancialAvailableResources extends ModuleImet {

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        const totals = computed(() => {
            let result = [];
            setup_obj.records.forEach(function (item, index) {
                result[index] = 0;
                result[index] += item['NationalBudget'] !== null ? parseFloat(item['NationalBudget']) : 0;
                result[index] += item['OwnRevenues'] !== null ? parseFloat(item['OwnRevenues']) : 0;
                result[index] += item['Disputes'] !== null ? parseFloat(item['Disputes']) : 0;
                result[index] += item['Partners'] !== null ? parseFloat(item['Partners']) : 0;
                result[index] = result[index]===0 ? null : result[index];
            });
            return result;
        });

        const percentages = computed(() => {
            let result = [];
            let totalPlannedBudget = parseFloat(getTotalBudget());
            setup_obj.records.forEach(function (item, index) {
                let total =  parseFloat(totals[index]);
                if(total>0 && totalPlannedBudget>0){
                    result[index] = (total/totalPlannedBudget*100).toFixed(1) + ' %';
                }
            });
            return result;
        });

        const sumTotals = computed(() => {
            let sum = 0;
            totals.value.forEach(function (item) {
                if(item!==null){
                    sum += item;
                }
            });
            return sum;
        });

        const totalIsValid = computed(() => {
            return sumTotals.value===null
                || sumTotals.value===''
                || isNaN(sumTotals.value)
                || (sumTotals.value>0
                    && parseFloat(sumTotals.value).toFixed(2)===parseFloat(getTotalBudget()).toFixed(2));
        });

        function getTotalBudget(){
            return window.FinancialResources.records[0]['TotalBudget'];
        }

    return {
        ...setup_obj,
        totals,
        percentages,
        sumTotals,
        totalIsValid
    };

    }

}
