/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

import ModuleImet from "../../Module.js";

import { watch } from "vue";

export default class CreateNonWDPA extends ModuleImet {

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        watch(setup_obj.records, () => {
            setup_obj.status.value = 'idle'; // set the status to idle (override standard behaviour)
            recordChanged();
        }, { deep: true });

        function recordChanged(){

            let empty = [];
            for (const [key, value] of Object.entries(setup_obj.records[0])) {
                if(value === null || value === ''){
                    empty.push(key);
                }
            }

            if(empty.includes('version') &&
                empty.includes('FormID') &&
                empty.includes('UpdateDate') &&
                empty.includes('UpdateBy')){
                if(empty.length === 4 ||
                    (empty.length === 5 &&  empty.includes('rep_m_area')) ||
                    (empty.length === 5 &&  empty.includes('rep_area'))
                ){
                   setup_obj.status.value = 'changed';
                } else {
                   setup_obj.status.value = 'init';
                }
            }
            else {
               setup_obj.status.value = 'init';
            }

        }

        return {
            ...setup_obj
        };

    }

}