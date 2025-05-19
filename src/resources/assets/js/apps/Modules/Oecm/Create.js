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
import { useLoadFromPrevious } from "../composables/module.load_from_previous";

export default class Create extends ModuleImet {

    constructor(input_data = {}) {

        const custom_props = {
            previous_url: {
                type: String,
                default: null
            }
        };

        return super(input_data, custom_props);
    }

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        const { show_language, retrieving_years, available_years, validateRecord, prev_year_selection } = useLoadFromPrevious({
            records: setup_obj.records,
            previous_url: props.previous_url,
        });

        watch(setup_obj.records, () => {
            setup_obj.status.value = 'idle'; // set the status to idle (override standard behaviour)
            setup_obj.status.value = validateRecord();
        }, { deep: true });

        return {
            ...setup_obj,
            show_language,
            retrieving_years,
            available_years,
            prev_year_selection
        };

    }

}