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
    <div>
        <div class="" @click="toggle_view()">
            <div :id="'menu-header-header-main'">
                <div class="list-head">
                    <span class="fas fa-fw" :class="{ 'fa-plus': !data.show_view, 'fa-minus': data.show_view }"></span>
                    {{ title }}
                </div>
            </div>
        </div>
        <div v-show="data.show_view">
            <div class="container-menu">
                <guidance :label="info_label"/>
                <slot :props="data"></slot>
            </div>
        </div>
    </div>
</template>
<script setup>
import {onMounted, inject, reactive, ref} from 'vue';

const stores = inject('stores');
const emitter = inject('emitter');
const data = reactive({
    show_view: false,
    loaded_once: false,
    show_loader: false
});

const props = defineProps({
    element: {
        type: String,
        default: ''
    },
    on_load: {
        type: Boolean,
        default: true
    },
    load_container: {
        type: Boolean,
        default: true
    },
    on_load_even: {
        type: String,
        default: null
    },
    show_menu: {
        type: Boolean,
        default: false
    },
    title: {
        type: String,
        default: ''
    },
    info_label: {
        type: String,
        default: ''
    },
    event_name: {
        type: String,
        default: ''
    }
});

onMounted(() => {
    emitter.on(props.event_name, () => {
        data.show_view = true;
    });
});

async function toggle_view() {
    data.show_view = !data.show_view;
}

</script>
