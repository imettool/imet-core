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
import imetScoreBar from "../../../../templates/imet_score_bar.vue";

export default class EcosystemServices extends ModuleImet {

    constructor(input_data = {}) {

        const custom_props = {
            groupsByCategory: {
                type: Object,
                default: () => input_data.groupsByCategory
            }
        };

        return super(input_data, custom_props)

            // Register components
            .component('imet_score_bar', imetScoreBar);
    }

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        /**
         * Calculate stats for each record
         */
        const recordStats = computed(() => {
            let stats = [];
            setup_obj.records.forEach(function(record){
                if(record['Importance']!==null
                    && record['ImportanceRegional']!==null
                    && record['ImportanceGlobal']!==null){
                    stats.push(
                        parseFloat(record['Importance'])
                        + (parseFloat(record['ImportanceRegional'])/3)
                        + ((2-parseFloat(record['ImportanceGlobal']))/4)
                    );
                } else {
                    stats.push(null);
                }
            });
            return stats;
        });

        /**
         * Calculate stats for each category
         */
        const categoryStats = computed(() => {
            let category_stats = [];
            props.groupsByCategory.forEach(function (groups_by_category) {

                let category_sum = 0;
                let category_count = 0;

                setup_obj.records.forEach(function (record, index) {
                    if (groups_by_category.includes(record[props.group_key_field])) {
                        let row_stats = recordStats.value[index];
                        if (row_stats !== null) {
                            category_sum += parseFloat(row_stats);
                            category_count++;
                        }
                    }
                });
                category_stats.push(
                    category_sum>0
                        ? ((category_sum/category_count)*100/3.0).toFixed(2)
                        : null
                );
            });
            return category_stats;
        });

        function categoryStat(index){
            return categoryStats.value[index];
        }


        return {
            ...setup_obj,
            recordStats,
            categoryStats,
            categoryStat
        };

    }

}