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
    <div ref="chartContainer" class="treemap" :style="'width:' + width + '; height: ' + height + ';'"></div>
</template>

<script setup>
import { ref, onMounted, computed, inject } from "vue";
import * as echarts from "~/echarts";
import { useResize } from "../../composables/resize";

const emitter = inject('emitter');
const chartContainer = ref(null);

const props = defineProps({
    width: {
        type: String,
        default: '100%'
    },
    height: {
        type: String,
        default: '500px'
    },
    values: {
        type: [Array, Object],
        default: () => {
        }
    },
    title: {
        type: String,
        default: ''
    }

});

const bar_options = computed(() => {
    return {
        title: {
            text: props.title,
            left: 'center'
        },
        series: [{
            type: 'treemap',
            data: data_fix()
        }]
    }
});

const { initResize } = useResize({
    emitter
});

onMounted(() => {
    draw_chart();
});

function data_fix() {
    return props.values.map(item => {
        return { name: item.label, value: item.area, itemStyle: { color: item.color } };
    })
}

function draw_chart() {
    if (Object.keys(props.values).length > 0) {
        if (chartContainer.value.clientWidth > 0 && chartContainer.value.clientHeight > 0) {
            let echartObject = echarts.init(chartContainer.value);
            echartObject.setOption(bar_options.value);

            initResize(echartObject);
        }
    }
}
</script>
