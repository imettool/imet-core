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

    <div ref=radar class="imet_process_radar" style="height: 250px;"></div>

</template>


<script setup>

import * as echarts from "~/echarts";
import { computed, ref, onMounted, watch } from "vue";

const props = defineProps({
    values:{
        type: Object,
        default: () => {}
    },
    labels: {
        type: Object,
        default: () => {}
    }
});

const radar = ref(null);

const radar_options = computed(() => {

    let values = Object.values(props.values).reverse();
    let labels = Object.keys(props.values).reverse().map((item) => {
        return {name: props.labels[item], max: 100};
    });

    return {
        tooltip: {
            trigger: 'axis'
        },
        radar: {
            indicator: labels,
            radius: '65%',
            startAngle: 150,
            axisName: {
                color: '#111',
                padding: [0, 0]
            },
        },

        series: [
            {
                type: 'radar',
                data: [
                    {
                        value: values,
                        itemStyle: {
                            color: '#7CB5EC'
                        },
                        areaStyle:{
                            color: '#7CB5EC',
                            opacity: 0.4,
                        },
                        symbolSize: 6,
                        name: 'imet_radar',
                        label: {
                            fontWeight: 'bold',
                            color: '#222',
                            show: true,
                            formatter:function(params) {
                                return params.value;
                            }
                        }
                    }
                ]
            }
        ]
    };
});

onMounted(() => {
    draw_chart();
});
watch(() => props.values, () => {
    draw_chart();
});

function draw_chart(){
    if(Object.keys(props.values).length>1) {

        echarts.init(radar.value)
            .setOption(radar_options.value);

    }
}


</script>
