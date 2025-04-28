import ModuleImet from "../../../Module.js";

import { computed } from "vue";

export default class Equipments extends ModuleImet {

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);

        const averages = computed(() => {
            return setup_obj.calculateGroupsAverages('AdequacyLevel');
        });

        const averages_percentage = computed(() => {
            let percentages = {};
            Object.entries(averages.value).forEach(([key, value]) => {
                percentages[key] = value/3*100;
            });

            return percentages;
        });

        return {
            ...setup_obj,
            averages,
            averages_percentage
        };

    }

}
