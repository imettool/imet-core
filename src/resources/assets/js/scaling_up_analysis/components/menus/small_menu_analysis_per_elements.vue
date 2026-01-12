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
        <div
          :class="isSelected(idx)"
          v-for="(item, idx) in list_names"
          v-html="item[1]"
          @click="scrollToSection(item[0])"
          :key="idx"
        >
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
  const excluded_items = ref([]);
  const selection = ref(null);

  const excludeItems = () => {
    excluded_items.value = props.exclude.split(',');
  };

  const listItems = () => {
    excludeItems();
    const objectEntries = Object.entries(props.items);
    if (objectEntries.length > 0) {
      objectEntries.forEach((item) => {
        if (!excluded_items.value.includes(item[0])) {
          if (item[1].length) {
            item[1].forEach((v) => {
              const { menu, name } = v;
              const menu_item = ['header', item[0], name];
              list_names.value.push([menu_item.join('-'), menu.header]);
            });
          } else {
            list_names.value.unshift(item[1]);
          }
        }
      });
    }
  };

  const scrollToSection = (idx) => {
    const element = document.getElementById(props.ids + idx);
    element.scrollIntoView({ behavior: "smooth" });
    selection.value = idx;
  };

  const isSelected = (index) => {
    return selection.value === index ? 'active' : '';
  };

  onMounted(() => {
    listItems();
  });
  </script>
