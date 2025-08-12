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
        :with-insert=withInsert
        ref="selectorDialogComponent"
    >

        <!-- api search - result search filters -->
        <template v-slot:searchResultFilters>
            <i>{{ Locale.getLabel('modular-forms::common.filter_results') }}: </i>&nbsp;&nbsp;
            {{ Locale.getLabel('modular-forms::entities.biodiversity.taxonomy.class') }}
            <select v-model=filterByClass v-on:change="filterList(true)" class="field-edit filterByClass">
                <option v-for="option in classes">
                    {{ option }}
                </option>
            </select>
            {{ Locale.getLabel('modular-forms::entities.biodiversity.taxonomy.order') }}
            <select v-model=filterByOrder v-on:change="filterList(false)" class="field-edit filterByOrder">
                <option v-for="option in orderByClass()">
                    {{ option }}
                </option>
            </select>
        </template>

        <!-- api search - result header -->
        <template v-slot:searchResultHeader>
            <th>{{ Locale.getLabel('modular-forms::entities.biodiversity.species', 1) }}</th>
        </template>

        <!-- api search - result items -->
        <template #searchResultItem="{ item }">
            <td><span class="result_left" v-html="getSpeciesDescription(item)"></span></td>
        </template>

    </selector-dialog>


</template>

<style lang="css" scoped>
    .result_left{
        text-align: left;
    }
    .field-edit.filterByClass,
    .field-edit.filterByOrder{
        width: 200px;
        margin: 0 5px;
    }
</style>


<script setup>

    import {ref, provide} from "vue";
    import selectorDialog from "@modular-forms/js/inputs/components/selector-dialog.vue";
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
        withInsert: {
            type: Boolean,
            default: false,
        },
        languages: {
            type: Array,
            default: () => ['eng', 'spa', 'por', 'fra', 'rus', 'deu', 'ita', 'jpn', 'zho', 'kor']
        }
    });

    // components, injections & expose
    const selectorDialogComponent = ref(null);
    provide('setLabel', setLabel);
    provide('setValue', setValue);
    provide('afterSearch', afterSearch);

    // values
    const inputValue = defineModel();
    const filterByClass = ref(null);
    const filterByOrder = ref(null);
    const orders = ref([]);
    const classes = ref([]);

    function setLabel(item){
        if(typeof item === "object"){
            // return scientific name
            return item.genus + ' ' + item.species;
        }
        else if(item.split("|").length>3){
            let taxonomy = item.split("|");
            return taxonomy[4] + ' ' + taxonomy[5]
        }
        return item;
    }

    function setValue(item){
        if (typeof item == "object") {
            // return full taxonomy
            return item.phylum
                + '|' + item.class
                + '|' + item.order
                + '|' + item.family
                + '|' + item.species
        }
        return item;
    }

    function getSpeciesDescription(item) {
        let description = '<div>' + item.class + ' ' + item.order + ' ' + item.family + ' <b>' + item.genus + ' ' + item.species + '</b>' + '</div>';
        if (hasCommonNames(item)) {
            description += '<div class="common_names"><b><i>' + Locale.getLabel('modular-forms::entities.biodiversity.common_names') + ':</i></b>';
            description += '<ul class="ml-5">';
            props.languages.forEach(function(language){
                if (typeof item['vernacular_names_' + language] !== undefined
                    && item['vernacular_names_' + language] !== null
                    && item['vernacular_names_' + language] !== ''
                    && item['vernacular_names_' + language].toLowerCase() !== 'null'
                ) {
                    description += '<li>' +item['vernacular_names_' + language].replace(/\,/g, ', ') + '</li>'
                }
            });
            description += '</ul>';
            description += '</div>';
        }
        return description;
    }

    function hasCommonNames(item) {
        let hasCommonNames = false;
        props.languages.forEach(function(language){
            if (item['vernacular_names_' + language] !== null) {
                hasCommonNames = true;
                return true;
            }
        })
        return hasCommonNames;
    }

    function afterSearch(data){
        orders.value = data['orders'];
        classes.value = data['classes'];
        filterByOrder.value = null;
        filterByClass.value = null;
    }

    function orderByClass(){
        return filterByClass.value!=null
            ? orders.value[filterByClass.value]
            : [];
    }

    function filterList(alsoResetOrder){
        if(alsoResetOrder){
            filterByOrder.value = null;
        }
        filterByOrder.value = typeof filterByOrder.value === "undefined" ? null : filterByOrder.value;
        selectorDialogComponent.value.filterShowList({
            'class': filterByClass.value,
            'order': filterByOrder.value,
        });
    }



</script>
