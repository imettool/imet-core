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
    <span class="checkbox" :class="dataClass">
        <input type="checkbox" :name="id" :id="'bool-check_' + id" :checked="isChecked" @click="checkChange" />
        <label :for="'bool-check_' + id" v-html="label"></label>
    </span>
</template>

<script setup>
import { ref, computed, watch, onBeforeMount, onMounted } from 'vue';

const props = defineProps({
    id: { type: String, default: '' },
    value: { type: [String, Number, Boolean, Array, Object], default: null },
    dataClass: { type: String, default: '' },
    dataRules: { type: String, default: '' },
    dataNumeric: { type: Boolean, default: false },
    label: { type: String, default: null },
    func: { type: Function, default: null },
});

const emit = defineEmits(['update:modelValue']);

const inputValue = ref(props.value === true || props.value === "1" || props.value === 1);

const isChecked = computed(() => {
    return inputValue.value === true || inputValue.value === 1 || inputValue.value === "1";
});

watch(() => props.value, (newValue) => {
    inputValue.value = newValue;
});

const checkChange = () => {
    inputValue.value = !inputValue.value;
    if (props.func) {
        props.func(props.id);
    } else {
        setModuleValue();
    }
};

const emitValue = (value) => {
    emit('update:modelValue', value);
};

onBeforeMount(() => {
    if (props.value === null) {
        setModuleValue();
    }
});

onMounted(() => {
    document.querySelector('.checkbox').classList.remove('field-edit');
});

const setModuleValue = () => {
    let moduleValue = false;
    if(props.dataNumeric){
        moduleValue = inputValue.value ? true : false;
    } else {
        moduleValue = inputValue.value;
    }
    emitValue(moduleValue);
};
</script>
