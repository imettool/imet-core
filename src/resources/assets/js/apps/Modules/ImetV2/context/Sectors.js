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

export default class Sectors extends ModuleImet {

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        const area_percentage = computed(() => {
            let result = [];
            let area = getPaArea();
            setup_obj.records.forEach(function (item, index) {
                let underControlArea = item['UnderControlArea'];
                if(isValid(area) && isValid(underControlArea) && underControlArea>0){
                    result[index] = (parseFloat(underControlArea) / parseFloat(area) * 100).toFixed(2);
                } else {
                    result[index] = null;
                }
            });
            return result;
        });
        const average_time = computed(() => {
            let result = [];
            setup_obj.records.forEach(function (item, index) {
                let UnderControlPatrolManDay = item['UnderControlPatrolManDay'];
                let area = item['UnderControlArea'];
                if(isValid(area) && isValid(UnderControlPatrolManDay) && UnderControlPatrolManDay>0){
                    result[index] = (parseFloat(UnderControlPatrolManDay) / parseFloat(area)).toFixed(2);
                } else {
                    result[index] = null;
                }
            });
            return result;
        });
        const sumUnderControlArea = computed(() => {
            return setup_obj.sumColumnFloat('UnderControlArea');
        });
        const UnderControlPatrolKm = computed(() => {
            return setup_obj.sumColumnFloat('UnderControlPatrolKm');
        });
        const UnderControlPatrolManDay = computed(() => {
            return setup_obj.sumColumnFloat('UnderControlPatrolManDay');
        });

        function getPaArea(){
            let area = window.Areas.getArea();
            if(area!==null){
                area = parseFloat(area.toString().replace(',', '.'));
            }
            return area;
        }

        function isValid(n) {
            return !isNaN(parseFloat(n))
                && isFinite(n)
                && n!==null;
        }


        return {
            ...setup_obj,
            area_percentage,
            average_time,
            sumUnderControlArea,
            UnderControlPatrolKm,
            UnderControlPatrolManDay
        };

    }

}
