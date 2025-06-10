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

export default class GeographicalLocation extends ModuleImet {

    setupApp(props, input_data) {
        let setup_obj = super.setupApp(props, input_data);

        const limit_exists = computed(() => {
            return setup_obj.records[0]['LimitsExist']==="true"
                || setup_obj.records[0]['LimitsExist']===true
                || setup_obj.records[0]['LimitsExist']===1
                || setup_obj.records[0]['LimitsExist']==='1';
        });

        return {
            ...setup_obj,
            limit_exists
        };

    }

}
