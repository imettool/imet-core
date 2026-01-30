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
        <ColorPicker
                    v-model:pureColor="color"
                    @pureColorChange="onChange"
                    shape="circle"
                    format="hex"
                    :disableFields="true"
                    :defaultColors="predefinedColors"
       ></ColorPicker>
    <input type="hidden" :value="colorValue" :name="`color-${text_box_name}`" :id="`color-${text_box_name}`" class="field-edit" readonly>
    </div>
</template>
<script setup>
import { ref, onMounted } from 'vue';
import { ColorPicker } from "~/vue3-colorpicker";
import "~/vue3-colorpicker/style.css";
const props = defineProps({
  text_box_name: {
    type: String,
    default: () => ''
  },
  default_color: {
    type: String,
    default: () => '#59c7f9'
  },
});

const color = ref('#F64272');
const colorValue = ref('');
const predefinedColors = ['#F64272', '#F6648B', '#F493A7', '#F891A6', '#FFCCD5'];

onMounted(() => {
  color.value = props.default_color;
  colorValue.value = getColor();
});

function getColor () {
  return color.value;
};

function onChange(newColor) {
  colorValue.value = getColor();
}
</script>
