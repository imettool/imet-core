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

    <selector-dialog
        v-model="inputValue"
        :parent-id=id
        :search-url=searchUrl
        :label-url=labelUrl
        :multiple=multiple
        :with-id=true
        :parent-search-params-valid=isSearchable
        ref="selectorDialogComponent"
    >

        <!-- api search - search by country -->
        <template v-slot:searchFilters>
            <span>
                <i>{{ Locale.getLabel('imet-core::common.country') }}</i> :
                <select v-model=selectedCountry class="field-edit !max-w-3xs !mx-2">
                    <option v-for="(label, iso) in dataCountries" :value=iso>
                        {{ label }}
                    </option>
                </select>
            </span>
        </template>

        <!-- api search - result header -->
        <template v-slot:searchResultHeader>
            <th>{{ Locale.getLabel('imet-core::common.name') }}</th>
            <th>{{ Locale.getLabel('imet-core::common.protected_area.wdpa_id',1) }}</th>
            <th>{{ Locale.getLabel('imet-core::common.country') }}</th>
            <th>{{ Locale.getLabel('imet-core::common.protected_area.iucn_category') }}</th>
        </template>

        <!-- api search - result items -->
        <template #searchResultItem="{ item }">
            <td><span class="result_left"><b>{{ item.name }}</b></span></td>
            <td><a v-if="item.wdpa_id!==null"
                   target="_blank"
                   :href="'https://www.protectedplanet.net/'+item.wdpa_id">{{ item.wdpa_id }}</a></td>
            <td>{{ item.country_name }}</td>
            <td>{{ item.iucn_category }}</td>
        </template>

    </selector-dialog>


</template>


<script setup>

import {ref, provide, computed} from "vue";
const selectorDialog = window.ModularForms.Components.selectorDialog;

const Locale = window.ModularForms.Helpers.Locale;

const props = defineProps({
    id: {
        type: String,
        default: null
    },
    searchUrl: {
        type: String,
        default: null
    },
    labelUrl: {
        type: String,
        default: null
    },
    multiple: {
        type: Boolean,
        default: false,
    },
    dataCountries: {
        type: Object,
        default: null
    }
});

// components, injections & expose
const selectorDialogComponent = ref(null);
provide('setLabel', setLabel);
provide('setValue', setValue);
provide('getSearchParams', getSearchParams);

// values
const inputValue = defineModel();
const selectedCountry = ref(null);

/**
 *
 */
const isSearchable = computed(() => {
    return selectedCountry.value !== null;
});

/**
 * Extend the default search params with the country filter
 */
function getSearchParams(){
    return {
        'country': selectedCountry.value
    };
}

function setLabel(item) {
   return item?.name
}

function setValue(item){
    return item?.wdpa_id;
}

</script>
