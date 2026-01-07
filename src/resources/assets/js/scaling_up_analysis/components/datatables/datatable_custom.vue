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
    <table id="global_scores">
        <thead>
            <th v-for="column in columns" @click="sort(column.field)" :key="column.field">
                {{ column.label }} <i :class="sort_icon(column.field)" />

            </th>
        </thead>
        <tbody>
            <tr v-for="(value, index) in items" :key="index">
                <td v-for="column in columns" v-html="value[column.field]" :key="column.field"></td>
            </tr>
        </tbody>
    </table>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import { useList } from './composables/list'

const props = defineProps({
    columns: {
        type: Array,
        default: () => []
    },
    values: {
        type: Array,
        default: () => []
    }
});

const list = ref([]);

const {
    filterList,
    sortList,
    sort_icon,
    customization,
    percentage,
    colorArea
} = useList({});

const items = computed(() => {

    let items = list.value;
    items = filterList(items);
    items = sortList(items);

    return items;

});


onMounted(() => {
    list.value = customization(props.values, props.columns);
});

</script>
