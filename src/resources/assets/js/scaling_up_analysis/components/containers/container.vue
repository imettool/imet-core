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
        <div v-if="show_loader">
            <i class="fa fa-spinner fa-spin text-primary-800"></i>
            <span class="sr-only">Loading...</span>
        </div>

        <div v-else>
            <div v-if="error_returned" class="connection_not_available"
                v-html="stores.BaseStore.localization('entities.connection_not_available')"></div>
            <div v-else-if="timeout" class="connection_not_available"
                v-html="stores.BaseStore.localization('entities.connection_not_available')"></div>
            <div v-else-if="error_wrong" class="connection_not_available"
                v-html="stores.BaseStore.localization('imet-core::analysis_report.error_wrong')"></div>
            <div v-else class="container-menu">
                <slot :props="data"></slot>
            </div>
        </div>
    </div>

</template>

<script setup>
import { onMounted, watch, inject, ref } from "vue";
import { useAjax } from "../../composables/ajax";
import { useErrorStates } from "../../composables/useErrorStates";
import { commonProps } from "./common/props";

// Use shared error states composable
const { show_loader, timeout, error_returned, error_wrong, setLoading, handleError } = useErrorStates();
const data = ref([]);
const props = defineProps({
    ...commonProps,
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
    trigger_incoming_data: {
        type: Object,
        default: null
    },
    randomKeyEvent: {
        type: String,
        default: ''
    }
});

const stores = inject('stores');
const emitter = inject('emitter');
const component_data = {
    func: props.func,
    url: props.url,
    method: props.method,
    on_load: props.on_load,
    loaded_at_once: props.loaded_at_once,
    parameters: Array.isArray(props.parameters) ? props.parameters?.slice(0, -1) : props.parameters,
    stores,
    trigger_incoming_data: props.trigger_incoming_data,
    success,
    error: handleError
};

let { init, on_event_load } = useAjax(component_data);

watch(() => props.loaded_at_once, async (newVal) => {
    if (newVal) {
        setLoading(true);
        try {
            await init();
        } catch (error) {
            console.error(error);
        } finally {
            setLoading(false);
        }
    }
}, { deep: true });

watch(() => props.trigger_incoming_data, async (newVal) => {
    if (newVal) {
        setLoading(true);
        try {
            await on_event_load(newVal);
        } catch (error) {
            console.error(error);
        }
        finally {
            setLoading(false);
        }
    }
}, { deep: true });

onMounted(async () => {
    if (props.loaded_at_once === true) {
        setLoading(true);
        try {
            await init();
        } catch (error) {
            console.error(error);
        }
        finally {
            setLoading(false);
        }
    }
});


function success(response, loader = false) {
    setLoading(loader);
    if (response.status === false) {
        timeout.value = true;
        return;
    }
    if (typeof response === 'object') {
        data.value = response.data;

        if (props.on_load_even !== null) {
            emitter.emit('component_loaded');
        }
    } else {
        error_returned.value = true;
    }
}


</script>
