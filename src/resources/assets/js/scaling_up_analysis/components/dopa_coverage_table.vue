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

  <div class="list-key-numbers" v-if="api_data!==null">

    <div class="list-head" v-if="title!=null">
      {{ title }}
    </div>

    <div v-for="item in indicators" :key="item.id">
      <div class="content">
        <span>{{ item.label }}</span>
        <span class="number" :style="{ color: item.color }">{{ getValue(item)| pretty_number(2) }}</span>
      </div>
    </div>

  </div>

</template>

<script>

export default {

    props: {
        title: {
            type: String,
            default: null
        },
        indicators: {
            type: [Array],
            default: () => null
        },
        api_data: {
            type: [Object],
            default: () => null
        },
    },

    filters: {

        pretty_number(value, precision = 0){
            value = Number(parseFloat(value).toFixed(precision));
            return isNaN(value)
                ? '-'
                : value.toLocaleString('fr-FR');  // french notation
        }


    },

    methods:{

        getValue(item){
            let value = null;
            if(item.hasOwnProperty('fields')){
                value = this.api_data[item.fields[item.fields.length - 1]]
            } else  if(item.hasOwnProperty('field')){
                value = this.api_data[item.field];
            }
            return parseFloat(value).toFixed(1);
        }

    }
}

</script>
