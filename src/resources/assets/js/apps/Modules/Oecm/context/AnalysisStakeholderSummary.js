
/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

import { createApp, reactive } from "vue";
export default class AnalysisStakeholderSummary {

    constructor(input_data = {}) {

        const options = {

            name: 'AnalysisStakeholderSummary',

            props: {
                key_elements_importance: {
                    type: Object,
                    default: () => {}
                }
            },

            setup(props, context) {

                const Locale = window.ModularForms.Helpers.Locale;
                let key_elements_importance = reactive(props.key_elements_importance);

                function refresh_importance(new_items) {
                    // remove everything
                    key_elements_importance.forEach(function (item, index) {
                        key_elements_importance.splice(index, 1);
                    });
                    // add back new items
                    new_items.forEach(function (item, index) {
                        key_elements_importance[index] = JSON.parse(JSON.stringify(new_items[index]));
                    });
                }

                function key_elements_importance_composition(element) {
                    return Locale.getLabel('imet-core::oecm_evaluation.KeyElements.key_elements_importance_composition', {
                        'imp_dir': '<b>' + element['importance_direct'] + '</b>',
                        'imp_ind': '<b>' + element['importance_indirect'] + '</b>',
                        'num_dir': '<b>' + element['stakeholder_direct_count'] + '</b>',
                        'num_ind': '<b>' + element['stakeholder_indirect_count'] + '</b>',
                    })
                }

                return {
                    key_elements_importance,
                    key_elements_importance_composition,
                    refresh_importance
                }

            }
        };

        return createApp(options, input_data)
    }

}