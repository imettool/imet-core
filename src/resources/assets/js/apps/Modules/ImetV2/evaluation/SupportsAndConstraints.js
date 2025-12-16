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

import { watch, nextTick, reactive } from "vue";

export default class SupportsAndConstraints extends ModuleImet {

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);
        const evaluation = reactive([]);
        const calculateScores = (evaluation) => {
            setup_obj.records.forEach((record, index) => {
                const field1Value = parseFloat(record.EvaluationScore) || 0;
                const field2Value = parseFloat(record.EvaluationScore2) || 0;
                const calculateValue = (field1Value + field2Value) * 100 / 6;
                let formattedScore = '';
                if(field1Value !== -99 && field2Value !== -99) {
                    formattedScore = (Math.abs(calculateValue) < 0) ? 0 : parseFloat(calculateValue.toFixed(1));
                }

                evaluation[index] = formattedScore;
            });
        };

        watch(() => setup_obj.records.map(r => [r.EvaluationScore, r.EvaluationScore2]),
            async () => {
                calculateScores(evaluation);
                await nextTick();
            },
            { deep: true }
        );

        calculateScores(evaluation);

        return {
            ...setup_obj,
            evaluation
        };

    }

}
