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

        const line_totals = computed(() => {
            let result = [];
            setup_obj.records.forEach(function (item, index) {
                    result[index] = 0;
                    result[index] += item['NationalBudget'] !== null ? parseFloat(item['NationalBudget']) : 0;
                    result[index] += item['OwnRevenues'] !== null ? parseFloat(item['OwnRevenues']) : 0;
                    result[index] += item['Disputes'] !== null ? parseFloat(item['Disputes']) : 0;
                    result[index] += item['Partners'] !== null ? parseFloat(item['Partners']) : 0;
                    result[index] = result[index] === 0 ? null : result[index];
            });
            return result;
        });

        const column_totals = computed(() => {
            let result = [
                null, // NationalBudget
                null, // OwnRevenues
                null, // Disputes
                null, // Partners
            ];
            setup_obj.records.forEach(function (item, index) {
                if(index> 0) {
                    if(item['NationalBudget'] !== null){
                        result[0] = result[0] !== null ? result[0] : 0;
                        result[0] += parseFloat(item['NationalBudget']);
                    }
                    if(item['OwnRevenues'] !== null){
                        result[1] = result[1] !== null ? result[1] : 0;
                        result[1] += parseFloat(item['OwnRevenues']);
                    }
                    if(item['Disputes'] !== null){
                        result[2] = result[2] !== null ? result[2] : 0;
                        result[2] += parseFloat(item['Disputes']);
                    }
                    if(item['Partners'] !== null){
                        result[3] = result[3] !== null ? result[3] : 0;
                        result[3] += parseFloat(item['Partners']);
                    }
                }
            });
            return result;
        });

        const sumTotals = computed(() => {
            let sum = null;
            line_totals.value.forEach(function (item, index) {
                if(index> 0 && item!==null){
                    sum = sum !== null ? sum : 0;
                    sum += item;
                }
            });
            return sum;
        });

        const nationalBudgetIsValid = computed(() => {
            return columnIsValid('NationalBudget', 0);
        });

        const ownRevenuesIsValid = computed(() => {
           return columnIsValid('OwnRevenues', 1);
        });

        const disputesIsValid = computed(() => {
           return columnIsValid('Disputes', 2);
        });

        const partnersIsValid = computed(() => {
           return columnIsValid('Partners', 3);
        });

        const totalIsValid = computed(() => {
            let reference_value = line_totals.value === null || isEmptyButValid(line_totals.value[0]) ? null : line_totals.value[0];
            return isEmptyButValid(reference_value)
                || isEmptyButValid(sumTotals.value)
                || parseFloat(sumTotals.value).toFixed(2) === parseFloat(reference_value).toFixed(2);
        });

        const annualTotalBudgetIsValid = computed(() => {
            return line_totals.value === null
                || isEmptyButValid(line_totals.value[0])
                || (line_totals.value[0]>0 &&
                    parseFloat(line_totals.value[0]).toFixed(2) === parseFloat(getTotalBudget()).toFixed(2));
        });

        function columnIsValid(field_name, col_index){
            let reference_value = setup_obj.records
                ? setup_obj.records[0][field_name]
                : null;
            return column_totals.value === null
                || isEmptyButValid(reference_value)
                || isEmptyButValid(column_totals.value[col_index])
                || (column_totals.value[col_index]>0 &&
                    parseFloat(column_totals.value[col_index]).toFixed(2) === parseFloat(reference_value).toFixed(2));
        }

        function isEmptyButValid(total){
            return total === null
                || total === ''
                || isNaN(total);
        }

        function getTotalBudget(){
            return window.FinancialResources.getTotalBudget();
        }

    return {
        ...setup_obj,
        line_totals,
        column_totals,
        sumTotals,
        annualTotalBudgetIsValid,
        nationalBudgetIsValid,
        ownRevenuesIsValid,
        disputesIsValid,
        partnersIsValid,
        totalIsValid
    };

    }

}
