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
      ref="selectorDialogComponent"
  >

    <!-- api search - result header -->
    <template v-slot:searchResultHeader>
      <th>{{ Locale.getLabel('imet-core::users.attributes.name') }}</th>
      <th>{{ Locale.getLabel('imet-core::users.attributes.email') }}</th>
      <th>{{ Locale.getLabel('imet-core::users.attributes.country') }}</th>
      <th>{{ Locale.getLabel('imet-core::users.attributes.organization') }}</th>
    </template>

    <!-- api search - result items -->
    <template #searchResultItem="{ item }">
      <td><span class="result_left"><b>{{ item.first_name }}</b></span></td>
      <td>
        <span v-if="item.country !== null">
                            <flag :iso2=item.country.iso2></flag>&nbsp;&nbsp;<i>{{ item.country.name }}</i>
                        </span>
      </td>
      <td>{{ item.email }}</td>
      <td>{{ item.organization }}</td>
    </template>

  </selector-dialog>
</template>

<style lang="postcss" scoped>

.module-container .selector-user{

  .field-preview{
    width: 450px;
    display: inline-block;
  }

}

</style>

<script setup>
import {provide, ref, watch} from "vue";
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
  }
});

const selectorDialogComponent = ref(null);
provide('setLabel', setLabel);
provide('setValue', setValue);

const inputValue = defineModel();

function setLabel(item) {
  return item?.name
}

function setValue(item){
  return item?.id;
}
</script>
