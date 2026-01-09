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
    <div ref=chartContainer class="bar" :style="'width:' + width + '; min-height: ' + height + ';'"></div>
</template>

<script setup>
import * as echarts from "~/echarts";
import { inject, ref, computed, onMounted, watch } from "vue";
import { useResize } from "../scaling_up_analysis/composables/resize";
import { useBar } from "../scaling_up_analysis/components/bar-charts/composables/bar";
import { common, commonProps } from "../scaling_up_analysis/components/bar-charts/common/commonProps";

const chartContainer = ref(null);
const emitter = inject('emitter');
const props = defineProps({
    ...common,
    ...commonProps,
    computedObject: {
        type: Object,
        default: null
    }
});


const { has_zoom, field_name, get_colors } = useBar({
    fields: props.fields,
    colors: props.colors,
    zoom: props.zoom
});

const { initResize } = useResize({
    emitter
})

const computedJSON = props.computedObject ?? {
    ...get_colors(),
    legend: {
        show: true,
        padding: [35, 0, 0, 0],
    },
    title: {
        text: props.title,
        left: 'center'
    },
    tooltip: {
        trigger: 'axis',
        axisPointer: {
            type: 'shadow'
        }
    },
    xAxis: {
        type: 'category',
        data: field_name(),
        axisLabel: {
            rotate: props.rotate,
            interval: 0
        },
        ...props.axis_dimensions_x
    },
    yAxis: {
        type: 'value',
        realtimeSort: true,
        minInterval: 1,
        ...props.axis_dimensions_y
    },
    grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
    },
    series: [{
        data: props.values,
        type: 'bar',
        name: props.title_data,
        ...props.series_data
    }],
    ...has_zoom()
}


const bar_options = computed(() => {
    return computedJSON;
}
);

onMounted(() => {
    if (props.values.length > 0) {
        draw_chart();
    }
})

function draw_chart() {
    if (props.values.length > 0) {
        let echartObject = echarts.init(chartContainer.value);
        echartObject.setOption(bar_options.value);
        initResize(echartObject);
    }
}
</script>
