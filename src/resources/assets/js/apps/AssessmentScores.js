/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

import { createApp, ref, onMounted } from "vue";
import { createPinia } from "~/pinia";
import imetScores from "../templates/imet_scores.vue";
import { useScoreStore } from "./ScoreStore";

export default class AssessmentScores {

    constructor(input_data = {}) {

        const options = {

            name: 'AssessmentScores',

            props: {
                api_data: {
                    type: Object,
                    default: () => input_data.api_data
                }
            },

            setup(props, context){

                const store = useScoreStore();
                store.init(props.api_data);

                function refresh_scores(){
                    store.refresh();
                }

                return {
                    refresh_scores,
                    store,
                }
            }
        }

        return createApp(options, input_data)
            .component('imet_scores', imetScores)
            .use(createPinia());
    }
}