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
        <div class="grid grid-cols-2 gap-4 pb-4 pt-4">
            <template v-if="pas.length > 0">
                <div v-for="(selection, i) in pas" :key="i" class="p-2 bg-yellow-100 rounded-sm border border-yellow-200">
                    <input type="checkbox" :checked="is_checked(selection.FormID)" class="vue-checkboxes" :data-name="selection.name"
                           @click="selectValue(selection.FormID)" :value="selection.FormID">
                    <strong>&nbsp;{{ selection.name }}</strong>
                </div>
            </template>
        </div>
        <div class="flex flex-row justify-center gap-4">
            <button :disabled="button_status()" @click="enable_overall()" class="btn-nav">{{
                    stores.BaseStore.localization('imet-core::analysis_report.apply')
                }}
            </button>
            <button @click="check_all()" class="btn-nav">{{
                    stores.BaseStore.localization('imet-core::analysis_report.select_all')
                }}
            </button>
            <button @click="clearSelections()" class="btn-nav red">{{
                    stores.BaseStore.localization('imet-core::analysis_report.reset')
                }}
            </button>
        </div>
        <div v-if="show_overall">
            <slot :props="{ 'ids': checkboxes_ids(), 'show_view': show_overall }"></slot>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, inject } from "vue";

// State
const are_checked_all = ref(false);
const checkboxes = ref([]);
const pas = ref([]);
const show_overall = ref(false);

// Injected dependencies
const emitter = inject('emitter');
const stores = inject('stores');

// Props
const props = defineProps({
    items: {
        type: Object,
        default: () => ({})
    },
    event: {
        type: String,
        default: ''
    },
    minimum_valid_items: {
        type: Number,
        default: 1
    }
});

onMounted(() => {
    pas.value = Object.entries(props.items)
        .map(([FormID, name]) => ({ FormID, name }))
        .sort((a, b) => a.name.localeCompare(b.name));
});

function is_checked(id) {
    return checkboxes.value.some(checkbox => parseInt(checkbox) === parseInt(id));
}

function selectValue(value) {
    const index = checkboxes.value.indexOf(value);

    if (index > -1) {
        checkboxes.value.splice(index, 1);
    } else {
        checkboxes.value.push(value);
        emitSelection();
    }

    show_overall.value = false;
}

function checkboxes_ids() {
    return checkboxes.value.join(',');
}

function enable_overall() {
    if (props.event) {
        emitter.emit(props.event, checkboxes_ids());
    } else {
        toggleOverallView();
    }
}

function toggleOverallView() {
    if (show_overall.value) {
        setTimeout(() => {
            show_overall.value = false;
        }, 500);
    } else {
        show_overall.value = true;
    }
}

function button_status() {
    return checkboxes.value.length <= props.minimum_valid_items;
}

function check_all() {
    if (are_checked_all.value) {
        clearSelections();
    } else {
        selectAllCheckboxes();
        are_checked_all.value = true;
    }
    emitSelection();
}

function selectAllCheckboxes() {
    const checkboxElements = document.querySelectorAll(".vue-checkboxes");

    checkboxElements.forEach(checkbox => {
        if (!is_checked(checkbox.defaultValue)) {
            checkboxes.value.push(checkbox.defaultValue);
        }
    });
}

// Emit selection data
function emitSelection() {
    emitter.emit('actionData', JSON.stringify(checkboxes.value));
}

// Clear all selections
function clearSelections() {
    checkboxes.value = [];
    are_checked_all.value = false;
}

</script>
