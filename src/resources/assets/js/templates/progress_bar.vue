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

    <div class="progress-bar" :class="{'stacked': stacked}">

        <template v-if="stacked">

            <template v-for="(item, index) in value">
                <template v-if="percent(item)!==null">
                    <div class="bar" :class="{'float-right': negative}" :style="style(item, index)">
                        <span v-if="width(item)>5">{{ percent(item) }}%</span>
                    </div>
                </template>
            </template>

        </template>
        <template v-else>

            <template v-if="percent(value)!==null">
                <div class="bar" :class="{'float-right': negative}" :style=style(value)></div>
                <div class="label">
                    {{ percent(value) }}%
                </div>
            </template>

        </template>

    </div>

</template>

<style scoped>

    @reference "@modular-forms/index.css";

    .progress-bar{
        position: relative;
        flex-grow: 1;
        border-radius: 4px;
        min-height: 24px;
        @apply bg-gray-100;
        .bar{
            min-height: 24px;
            border-radius: 4px;
        }
        .label{
            position: absolute;
            top: 25%;
            width: 100%;
            text-align: center;
            font-weight: bold;
        }

        &.stacked{
            @apply flex flex-row;
            .bar{
                @apply flex items-center justify-center font-bold;
            }
        }

    }

</style>

<script setup>

import { computed } from "vue";

const props = defineProps({
    value: {
        type: [Number, Array],
        default: () => 0
    },
    color: {
        type: String,
        default: () => ''
    },
    digit:  {
        type: Number,
        default: () => 2
    },
    negative: {
        type: Boolean,
        default: false
    },
    stacked: {
        type: Boolean,
        default: false
    }
});

function percent(value){
    if(value === null) return null;
    return parseFloat(value).toFixed(props.digit);
}

function width(value){
    return Math.abs(value);
}


function style(value, index = null){
    let color = props.color;
    if(index != null){
        let lightness = index * 5;
        color = 'hsl(from ' + color + ' h s calc(l + ' + lightness + '))';
    }
    return 'width: ' +  width(value).toFixed(props.digit) + '%; background-color: ' + color + ' !important;';
}

</script>

