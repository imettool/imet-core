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
    <div class="mt-2">
        <div class="text-editor-edit" v-if="props.action === 'edit'">
            <editor :model-value="modelValue" @update:modelValue="updateContent"></editor>
        </div>
        <div v-else-if="props.action === 'show'" class="field-preview" style="max-width: none; margin-bottom: 10px;">
            <div v-html="modelValue"></div>
        </div>
        <div class="text-editor-print" v-html=modelValue></div>
    </div>
</template>

<script setup>
const props = defineProps({
    modelValue: {
        type: String,
        required: true
    },
    action: {
        type: String,
        required: true,
        validator: (value) => ['edit', 'show'].includes(value)
    },
    field: {
        type: String,
        required: false
    }
});

const emit = defineEmits(['update:modelValue']);

const updateContent = (value) => {
    emit('update:modelValue', value);
};
</script>

<style lang="postcss" scoped>
.text-editor-edit {
    @media print {
        display: none;
    }
}

.text-editor-print {
    background-color: white !important;
    padding: 15px;

    @media screen {
        display: none;
    }
}
</style>
