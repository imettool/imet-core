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

import { computed } from "vue";

export default class Threats extends ModuleImet {

    constructor(input_data = {}) {

        const custom_props = {
            threats: {
                type: Object,
                default: () => input_data.threats
            },
        };

        return super(input_data, custom_props);
    }

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        const threat_stats = computed(() => {

            let stats = {};

            Object.entries(props.threats).forEach(([key, value]) => {
                let stat = null;

                setup_obj.records.forEach(function(record){
                    if(record['__threat_key'] === key){
                        let prod = 1
                            * (record['Impact']!==null ? 4-parseInt(record['Impact']) : 1)
                            * (record['Extension']!==null ? 4-parseInt(record['Extension']) : 1)
                            * (record['Duration']!==null ? 4-parseInt(record['Duration']) : 1)
                            * (record['Trend']!==null ?(5/2 - parseInt(record['Trend'])*3/4) : 1)
                            * (record['Probability']!==null ? 4-parseInt(record['Probability']) : 1);
                        let count =
                            (record['Impact']!==null ? 1 : 0)
                            + (record['Extension']!==null ? 1 : 0)
                            + (record['Duration']!==null ? 1 : 0)
                            + (record['Trend']!==null ? 1 : 0)
                            + (record['Probability']!==null ? 1 : 0);

                        let score = count>0
                            ? (4 - Math.pow(prod, (1/count)))
                            : null;

                        score = score!==null
                            ? ((0 - score) * 100 / 3).toFixed(1)
                            : null;

                        stats[key] = score;
                    }
                })

            });


            return stats;

        });

        return {
            ...setup_obj,
            threat_stats
        };

    }

}
