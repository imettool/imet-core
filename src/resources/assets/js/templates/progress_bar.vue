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

    <div class="progress-bar" >
        <div class="bar" :class="{'float-right': negative}" :style=style v-if="percentage_value!==null"></div>
        <div class="label" v-if="percentage_value!==null">
            {{ percentage_value }}% {{ additional_label }}
        </div>
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
    }

</style>

<script setup>

import { computed } from "vue";

const props = defineProps({
    value: {
        type: [Number, String],
        default: () => 0
    },
    color: {
        type: String,
        default: () => ''
    },
    additional_label: {
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
    }
});

const style = computed(() => {
    return 'width: ' +  Math.abs(props.value).toFixed(props.digit) + '%; background-color: ' + props.color + ' !important;';
});

const percentage_value = computed(() => {
    if(props.value === null) return null;
    return typeof props.value === 'number'
        ? props.value.toFixed(props.digit)
        : parseFloat(props.value).toFixed(props.digit);
});

</script>

