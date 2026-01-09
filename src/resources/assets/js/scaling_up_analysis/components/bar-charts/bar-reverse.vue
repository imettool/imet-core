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
    <imet_bar_chart
                    :title_data="title_data"
                    :title="title"
                    :values="values"
                    :colors="colors"
                    :fields='fields'
                    :rotate="props.rotate"
                    :computed-object="bar_options"
    ></imet_bar_chart>
</template>
<script setup>
import {useBar} from './composables/bar.js';
import imet_bar_chart from '../../../templates/imet_bar_chart.vue';
import {commonProps, common} from "./common/commonProps";
import {computed} from "vue";

const props = defineProps({
    ...common,
    ...commonProps,
});

const {has_zoom, field_name, get_colors} = useBar({
    fields: props.fields,
    colors: props.colors,
    zoom: props.zoom
});

const bar_options = computed(() => {
        return {
            legend: {show: true,
                padding: [30, 0, 0, 0]},
            colors: ['#5470C6'],
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
                type: 'value',
                realtimeSort: true,
                minInterval: 1,
                max: 0,
                min: -100
            },
            yAxis: {
                position: 'right',
                type: 'category',
                data: field_name(),
                axisLabel: {
                    rotate: props.rotate,
                    interval: 0
                }
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            series: [{
                data: props.values,
                label: {
                    show: true,
                    position: 'left'
                },
                name: props.title_data,
                type: 'bar'
            }],
            ...has_zoom()
        };
    }
);
</script>
