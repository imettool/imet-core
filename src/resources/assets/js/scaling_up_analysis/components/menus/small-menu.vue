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
    <div class="smallMenu" style="min-height: 80px;">
        <div class="standalone js-smallMenu" id="smallMenu" v-if="list_names.length > 1">
            <div :class="{ active: isSelected(idx) }" v-for="(item, idx) in list_names" v-html="item"
                @click="scrollToSection(idx)" :key="idx">
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps({
    items: {
        type: [Object, Array],
        default: () => ({}),
    },
    exclude: {
        type: String,
        default: '',
    },
    ids: {
        type: String,
        default: '',
    },
    root_dir: {
        type: String,
        default: '',
    },
});

const list_names = ref([]);
const selection = ref(null);

const excluded_items = props.exclude.split(',');

const listItems = () => {
    const objectEntries = Object.entries(props.items);
    if (objectEntries.length > 0) {
        objectEntries.forEach((item) => {
            if (!excluded_items.includes(item[0])) {
                list_names.value.unshift(item[0]);
            }
        });
    }
};

const scrollToSection = (idx) => {
    const element = document.getElementById(props.ids + idx);
    element?.scrollIntoView({ behavior: "smooth" });
    selection.value = idx;
};

const isSelected = (index) => selection.value === index;

onMounted(() => {
    listItems();
});
</script>
