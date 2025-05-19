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
    <div :style="'background-color:'+ color" class="drop-zones d-grid gap-1 rounded-sm"
         @drop='onDrop($event)' @dragover.prevent
         @dragenter.prevent>
      <slot></slot>
    </div>
</template>
<script setup>
import {inject} from 'vue';


const emit = defineEmits(['drop-element']);
const props = defineProps({
    drop_id: {
        type: Number,
        default: 0
    },
    visible: {
        type: Boolean,
        default: true
    },
    color: {
        type: String,
        default: '#f8f9fa'
    }
});


const onDrop = (evt) => {
    emit('drop-element', evt, props.drop_id);
};
</script>

<style lang="postcss" scoped>
.drop-zones {
  background-color: #eee;
  margin-bottom: 10px;
  padding: 10px;
  min-height: 200px;
  min-width: 250px;
  max-height: 400px;
  overflow: auto;
}
</style>
