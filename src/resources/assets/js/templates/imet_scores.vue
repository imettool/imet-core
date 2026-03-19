<!--
  - Copyright (C) 2025 European Union
  - This program is free software: you can redistribute it and/or modify it under the terms of the
  - EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
  - This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
  - warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
  - further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
  - If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
  -->

<template>

    <!-- ##### GLOBAL ##### -->
    <div class="flex w-full flex-row items-center">
        <!-- histogram -->
        <div class="grow">
            <div v-for="(step_props, step_key) in properties" :key="step_key">
                <imet_score_row :label="labels[step_key]" :value="api_data['scores'][step_key].avg_indicator"
                    :color=step_props.color :short-label=true></imet_score_row>
            </div>
        </div>
        <!-- radar -->
        <div>
            <imet_radar :values="radar_values" :width="380" :height="250"></imet_radar>
        </div>
    </div>

    <!-- ##### STEPS ##### -->
    <template v-for="(step_props, step_key) in properties">

        <div class="mb-10" v-if="current_step === step_key || current_step === 'management_effectiveness'" :key="step_key">

            <!-- Title + synthetic score-->
            <imet_score_row :label="labels[step_key]" :value="api_data['scores'][step_key].avg_indicator"
                :color=step_props.color :is-header=true></imet_score_row>

            <!-- Scores-->
            <div v-for="(index, idx) in step_props.indexes" :key="index">
                <imet_score_row :label="labels[index]" :code=index :value="api_data['scores'][step_key][index]"
                    :histogram_type="histogram_type(step_key, idx)" :color=step_props.color></imet_score_row>
            </div>
            <!-- synthetic indicator for outcomes -->
            <div class="mt-4 border-t border-gray-400 pt-2 mt-2" v-if="step_key === 'outcomes' && version !== 'oecm'">
                <imet_score_row :label="labels['synthetic_indicator']" :class_values="'text-right font-bold'"
                                :value="api_data['scores']['outcomes']['synthetic_indicator']" histogram_type="0_to_100_full_width"
                                :color=step_props.color></imet_score_row>
            </div>
            <!-- custom additional scores -->
            <div class="mt-4" v-if="step_key === 'context' && version !== 'oecm'">
                <template v-for="ctx_key in ['C11', 'C12', 'C13', 'C14', 'C15']" :key="ctx_key">
                    <imet_score_row :label="labels[ctx_key]" :code=ctx_key
                        :value="api_data['scores']['context'][ctx_key]" histogram_type="0_to_100"
                        :color=step_props.color></imet_score_row>
                </template>
            </div>
            <div class="mt-4" v-else-if="step_key === 'process' && version !== 'oecm'">
                <imet_process_radar :values="[
                    api_data['scores']['process']['PRA'],
                    api_data['scores']['process']['PRB'],
                    api_data['scores']['process']['PRC'],
                    api_data['scores']['process']['PRD'],
                    api_data['scores']['process']['PRE'],
                    api_data['scores']['process']['PRF']
                ]" :labels="[
                        labels['PRA'],
                        labels['PRB'],
                        labels['PRC'],
                        labels['PRD'],
                        labels['PRE'],
                        labels['PRF']
                    ]"></imet_process_radar>
            </div>

        </div>

    </template>

</template>

<script setup>

import { computed } from "vue";
import { storeToRefs } from "~/pinia";
import imet_score_row from "./imet_score_row.vue";
import imet_process_radar from "./imet_process_radar.vue";
import imet_radar from "./imet_radar.vue";

const props = defineProps({
    current_step: {
        type: String,
        default: null
    },
    version: {
        type: String,
        default: null
    },
    labels: {
        type: Object,
        default: () => { }
    },
    store: null
});

const { api_data } = storeToRefs(props.store);

const score_properties = {

    'v1&2': {
        'context': {
            'indexes': ['C1', 'C2', 'C3'],
            'histogram_types': ['0_to_100', 'minus100_to_100', 'minus100_to_0'],
            'color': '#FFFF00',
        },
        'planning': {
            'indexes': ['P1', 'P2', 'P3', 'P4', 'P5', 'P6'],
            'color': '#BFBFBF',
        },
        'inputs': {
            'indexes': ['I1', 'I2', 'I3', 'I4', 'I5'],
            'color': '#FFC000'
        },
        'process': {
            'indexes': [
                'PR1', 'PR2', 'PR3', 'PR4', 'PR5', 'PR6', 'PR7', 'PR8', 'PR9', 'PR10',
                'PR11', 'PR12', 'PR13', 'PR14', 'PR15', 'PR16', 'PR17', 'PR18', 'PR19'
            ],
            'color': '#00B0F0'
        },
        'outputs': {
            'indexes': ['OP1', 'OP3', 'OP4'],
            'color': '#92D050'
        },
        'outcomes': {
            'indexes': ['OC1', 'OC2', 'OC3'],
            'histogram_types': ['0_to_100', 'minus100_to_0', 'minus100_to_0'],
            'color': '#00B050'
        },
    },

    'oecm': {
        'context': {
            'indexes': ['C1', 'C2', 'C3', 'C4'],
            'histogram_types': ['0_to_100', 'minus100_to_100', 'minus100_to_0', '0_to_100'],
            'color': '#FFFF00',
        },
        'planning': {
            'indexes': ['P1', 'P2', 'P3', 'P4', 'P5', 'P6'],
            'color': '#BFBFBF',
        },
        'inputs': {
            'indexes': ['I1', 'I2', 'I3', 'I4', 'I5'],
            'color': '#FFC000'
        },
        'process': {
            'indexes': ['PR1', 'PR2', 'PR3', 'PR4', 'PR5', 'PR6', 'PR7', 'PR8', 'PR9', 'PR10', 'PR11', 'PR12'],
            'color': '#00B0F0'
        },
        'outputs': {
            'indexes': ['OP1', 'OP2'],
            'color': '#92D050'
        },
        'outcomes': {
            'indexes': ['OC1', 'OC2', 'OC3'],
            'histogram_types': ['0_to_100', '0_to_100', 'minus100_to_100'],
            'color': '#00B050'
        },
    }

};

const properties = computed(() => {
    return props.version === 'oecm'
        ? score_properties[props.version]
        : score_properties['v1&2'];
});

const radar_values = computed(() => {
    let radar_values = {};
    Object.keys(properties.value).forEach(function (step) {
        let label = props.labels[step];
        radar_values[label] = api_data.value['scores'][step].avg_indicator || null;
    });
    return radar_values;
});


function histogram_type(step_key, idx) {
    return properties.value[step_key].hasOwnProperty('histogram_types')
        ? properties.value[step_key].histogram_types[idx]
        : '0_to_100_full_width';
}


</script>
