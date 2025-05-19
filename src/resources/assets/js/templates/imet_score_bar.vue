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

    <div class="score-bar text-2xs">

        <div v-if="showLimits && min!==null" class="score-bar__limit-left">{{ min }}%</div>

        <progress_bar
            :value=score_value
            :color=color
            :negative=negative
        ></progress_bar>

        <div v-if="showLimits && max!==null" class="score-bar__limit-right">{{ max }}%</div>

    </div>

</template>

<style lang="postcss" scoped>

    .score-bar{
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        width: 100%;
        align-items: center;
        margin: 1px 0;

      .score-bar__limit-left,
      .score-bar__limit-right{
          width: 40px;
          font-weight: bold;
      }

        .score-bar__limit-left{
            text-align: right;
            padding-right: 3px;
        }

        .score-bar__limit-right{
            text-align: left;
            padding-left: 3px;
        }
    }

</style>

<script setup>

import { computed } from "vue";
import progress_bar from "./progress_bar.vue";

const props = defineProps({
    value: {
        type: [String, Number],
        default: 0
    },
    color: {
        type: String,
        default: '#ccc'
    },
    showLimits: {
        type: Boolean,
        default: true
    },
    min: {
        type: Number,
        default: 0
    },
    max: {
        type: Number,
        default: 100
    },
});

const score_value = computed(() => {
    if(props.value === null) return null;
    return typeof props.value === 'number'
        ? props.value.toFixed(1)
        : parseFloat(props.value).toFixed(1);
});

const negative = computed(() => {
    return props.value < 0 || props.min < 0;
});


</script>
