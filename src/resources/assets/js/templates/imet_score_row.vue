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

    <div class="histogram-row" :class="{'border-b border-gray-400 pb-2 mb-2': isHeader}">

        <!-- code -->
        <div class="histogram-row__code text-center font-bold" v-if="!isHeader && code!=null">{{ code }}</div>

        <!-- label -->
        <div :class="[ 'histogram-row__title', class_values, { 'text-xl font-bold text-primary-600': isHeader, 'short': shortLabel || isHeader } ]">{{ label }}</div>

        <!-- value -->
        <div class="histogram-row__value text-right font-bold">{{ props.histogram_type === 'stacked' ? format(sum(value)) : format(value) }}</div>

        <!-- histogram -->
        <div class="histogram-row__progress-bar text-2xs pl-4" :style=grid_according_to_histogram_type>

            <template v-if="histogram_type==='0_to_100_full_width'">
                <imet_score_bar
                    :value=format(value)
                    :color=color
                ></imet_score_bar>
            </template>

            <template v-else-if="histogram_type==='0_to_100'">
                <div class="histogram-row__progress-bar__spacer"></div>
                <imet_score_bar
                    :value=format(value)
                    :color=color
                ></imet_score_bar>
            </template>

            <template v-else-if="histogram_type==='minus100_to_0'">
                <imet_score_bar
                    :value=format(value)
                    :color=color
                    :min=-100
                    :max=0
                ></imet_score_bar>
                <div class="histogram-row__progress-bar__spacer"></div>
            </template>

            <template v-else-if="histogram_type==='minus100_to_100'">
                <imet_score_bar
                    :value="format(value)<0 ? format(value): null"
                    :color=color
                    :min=-100
                    :max=null
                ></imet_score_bar>
                <imet_score_bar
                    :value="format(value)>0 ? format(value): null"
                    :color=color
                    :min=null
                    :max=100
                ></imet_score_bar>
            </template>

            <template v-else-if="histogram_type==='stacked'">
                <imet_score_bar
                    :value=value
                    :color=color
                    :stacked=true
                ></imet_score_bar>
            </template>

        </div>
    </div>

</template>


<script setup>

import { computed } from "vue";
import imet_score_bar from "./imet_score_bar.vue";

const props = defineProps({
    value: {
        type: [String, Number, Array],
        default: null
    },
    code: {
        type: String,
        default: null
    },
    label: {
        type: String,
        default: null
    },
    color: {
        type: String,
        default: '#aaa'
    },
    histogram_type: {
        type: String,
        default: '0_to_100_full_width'
    },
    isHeader: {
        type: Boolean,
        default: false
    },
    shortLabel: {
        type: Boolean,
        default: false
    },
    class_values: {
        type: String,
        default: 'text-left'
    }
});

const grid_according_to_histogram_type = computed(() => {
    if(props.histogram_type === '0_to_100') {
        return 'display: grid; grid-template-columns: calc(50% - 40px)  calc(50% + 40px);';
    }
    else if(props.histogram_type === 'minus100_to_0'){
        return 'display: grid; grid-template-columns: calc(50% + 40px)  calc(50% - 40px);';
    }
    else if(props.histogram_type === 'minus100_to_100'){
        return 'display: grid; grid-template-columns: 50% 50%;';
    }
    else {
        return '';
    }
});

function format(value) {
    if(value === null) return null;
    return typeof value === 'number'
        ? value.toFixed(1)
        : parseFloat(value).toFixed(1);
}

function sum(value){
    return value.reduce((acc, num) => acc + num, 0);
}



</script>
