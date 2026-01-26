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
    <div class="mb-4">
        <div class="mb-3 mt-1" style="font-size: 12px" v-if="average.length">
            <div class="align-center">
                {{ stores.BaseStore.localization("imet-core::analysis_report.average_explained") }}
            </div>
        </div>
        <table id="global_scores">
            <thead>
                <tr>
                    <th v-for="(column, idx) in columns" @click="sort(column.field)"
                        :style="idx === 0 ? 'width:15%;' : 'width:11%;'" :key="column.field">
                        {{ column.label.charAt(0).toUpperCase() + column.label.slice(1) }} {{ (column.extra_label) }} <i
                            :class="sort_icon(column.field)" />
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(value, index) in items" :key="index">
                    <template v-if="items[index]['name'] !== 'Average'">
                        <td v-for="(column, idx) in columns" v-html="get_value(value[column.field])"
                            :class="idx === 0 ? '' : score_class(value[column.field])" :key="column.field"></td>
                    </template>
                    <template v-else>
                        <td v-for="column in columns" v-html="get_value(value[column.field])" :key="column.field"></td>
                    </template>
                </tr>
            </tbody>
        </table>
        <div class="flex flex-row items-center text-sm">
            <div class="text-right mr-4">
                {{ stores.BaseStore.localization("imet-core::analysis_report.scaling_legend") }} :
            </div>
            <div v-for="legend in legendItems" :key="legend.value"
                 class="text-center px-3 py-2" :class="score_class(legend.value)">
                {{ legend.label }}
            </div>
        </div>
    </div>
</template>

<script setup>
import { inject, watch, ref, computed } from 'vue';
import { useList } from './composables/list'

const props = defineProps({
    columns: {
        type: Array,
        default: () => []
    },
    values: {
        type: Array,
        default: () => []
    },
    default_order: {
        type: String,
        default: null
    },
    default_order_dir: {
        type: String,
        default: "asc"
    },
    refresh_average: {
        type: Boolean,
        default: true
    }
});

const stores = inject('stores');
const list = ref([]);
const average = ref([]);
const {
    filterList,
    sortList,
    sort_icon,
    score_class,
    calculateAverage,
    get_value,
    sort
} = useList({ sortBy: props.default_order, sortDir: props.default_order_dir });

watch(() => props.values, (newValues) => {
    list.value = newValues;
}, { immediate: true });

const items = computed(() => {
    let items = [];
    if (list.value.length) {
        items = [...list.value];

        items = filterList(items);
        if (props.refresh_average) {
            items = calculateAverage(items);
        }
        items = sortList(items);
    }
    return items;
});

const legendItems = computed(() => {
    const to = stores.BaseStore.localization("imet-core::analysis_report.to").toLowerCase();
    return [
        { value: null, label: stores.BaseStore.localization("imet-core::analysis_report.no_value").toLowerCase() },
        { value: -52, label: `-100 ${to} -51` },
        { value: -35, label: `-50 ${to} -34` },
        { value: -1, label: `-33 ${to} 0` },
        { value: 10, label: `1 ${to} 33` },
        { value: 34, label: `34 ${to} 50` },
        { value: 51, label: `51 ${to} 100` }
    ];
});
</script>
