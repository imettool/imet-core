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
    <button :class="className" v-on:click="action">
        {{ label }}
    </button>
</template>


<script setup>
import {inject, onMounted, ref} from "vue";

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

const data = ref([]);
const isEnabled = ref(false);
const emitter = inject('emitter');

onMounted(() => {
       emitter.on('actionData', (data) => {
            eventFunction(data);
        })
})

function eventFunction(value) {
    data.value = value;
    isEnabled.value = true;
}
function resetValues() {
    isEnabled.value = false;
    data.value = [];
}
function action() {
    if (props.event) {
        emitter.emit(props.event);
        resetValues();
    }

}

</script>
