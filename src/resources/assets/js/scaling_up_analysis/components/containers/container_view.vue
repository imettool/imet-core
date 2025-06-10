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
            <div v-if="data.show_loader">
                <i class="fa fa-spinner fa-spin fa-2x text-primary-800"></i>
                <span class="sr-only">Loading...</span>
            </div>
            <div v-else>
                <div v-if="error_returned" class="dopa_not_available"
                    v-html="stores.BaseStore.localization('entities.dopa_not_available')"></div>
                <div v-else-if="timeout" class="dopa_not_available"
                    v-html="stores.BaseStore.localization('entities.dopa_not_available')"></div>
                <div v-else-if="error_wrong" class="dopa_not_available"
                    v-html="stores.BaseStore.localization('imet-core::analysis_report.error_wrong')"></div>
                <div v-else class="container-menu">
                    <guidance :label="info_label" />
                    <slot :props="data"></slot>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { onMounted, inject, reactive } from 'vue';

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
    emitter.on( props.event_name, () => {
                data.show_view = true;
    });
});

async function toggle_view() {
    data.show_view = !data.show_view;
}

</script>
