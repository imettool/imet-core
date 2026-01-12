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
  <div class="mt-5" v-show=show_element>
    <div class="strong">{{ title }}</div>
    <slot></slot>
    <div v-for="(list, index) in values" class="mt-3 ml-3" id="collapse-habitats" :key="index">
      <div class="strong">{{ index }}</div>
      <ul>
        <li v-for="(item, k) in list[0]" :key="k">
          {{ item }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  name: "elements",
  props: {
    values: {
      type: [Array, Object],
      default: () => {
      }
    },
    show_element: {
      type: Boolean,
      default: false
    },
    comment_title: {
      type: String,
      default: ''
    },
    title: {
      type: String,
      default: ''
    }
  }
}
</script>
