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

import { ref, watch } from "vue";

export default class Spillover extends ModuleImet {

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        const show_other_obs_supporting = ref(is_visible('SupportingKeyObservations'));
        const show_other_obs_provisioning = ref(is_visible('ProvisioningKeyObservations'));

        watch(setup_obj.records, () => {
            if(is_visible('SupportingKeyObservations')){
                show_other_obs_supporting.value = true;
            } else {
                show_other_obs_supporting.value = false;
                setup_obj.records[0]['SupportingOtherObservation'] = null;
            }
            if(is_visible('ProvisioningKeyObservations')){
                show_other_obs_provisioning.value = true;
            } else {
                show_other_obs_provisioning.value = false;
                setup_obj.records[0]['ProvisioningOtherObservation'] = null;
            }
        }, { deep: true });

        function is_visible(field){
            return setup_obj.records[0][field] === 'other';
        }

        return {
            ...setup_obj,
            show_other_obs_supporting,
            show_other_obs_provisioning
        };

    }

}
