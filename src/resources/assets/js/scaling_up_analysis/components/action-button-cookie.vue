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
    <button :class="className" v-on:click="store_to_cookie_by_id_and_value('analysis')">
        {{ label }}
    </button>
</template>

<script setup>
import {inject, onMounted} from 'vue';

const props = defineProps({
    event: {
        type: String,
        default: '',
    },
    className: {
        type: String,
        default: 'btn-nav float-left'
    },
    label: {
        type: String,
        default: 'Submit'
    }
});

const emitter = inject('emitter');
const selected = inject('selected');

onMounted(() => {
    emitter.on('store_cookie_and_value', (name, values) => {
        store_to_cookie_by_id_and_value(name, values);
    })
})

function store_to_cookie_by_id_and_value(cookieName, data_values = null) {
    if (data_values === null) {
        data_values = selected.value;
    }
    if (data_values.length > 0) {
        const cookie = get_cookie();
        if (cookie) {
            const cookie_arr = cookie.split('=');
            const cookie_items = JSON.parse(cookie_arr[1]);
            const merge_values = [...cookie_items, ...(data_values)];
            const total = merge_values.reduce((arr, item) => {
                if (Array.isArray(arr)) {
                    return arr.some(a => a.id == item.id) ? arr : [...arr, item];
                }

                return arr.id === item.id ? [arr] : [arr, item];
            });
            window.ModularForms.Helpers.Cookie.create(cookie[0], JSON.stringify(total));
        } else {
            window.ModularForms.Helpers.Cookie.create(cookieName, JSON.stringify(data_values));
        }
        //selected.value = [];
        emitter.emit('update_cloud_tags');
    }

}

function get_cookie(cookieName){
    return window.ModularForms.Helpers.Cookie.getByName(cookieName);
}
</script>
