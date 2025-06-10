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
        <slot></slot>
    </div>
</template>

<script setup>

import { provide } from 'vue';

import LocalStore from './../stores/local.storage.store';
import basket_store from './../stores/basket.store';
import base_store from './../stores/base.store';

const props = defineProps({
    scaling_up_id: {
        type: Number,
        default: 0
    },
    labels: {
        type: String,
        default: ""
    }
});

const initializeScalingUpLabels = () => {
    window.ScalingUp = {};
    window.ScalingUp.labels = function (label) {

        return props.labels[label] ?? label;
    }
};

initializeScalingUpLabels();

import config from './../config/config.js';

const stores = {
    BasketStore: new basket_store({ scaling_up_id: props.scaling_up_id }),
    BaseStore: new base_store({ scaling_up_id: props.scaling_up_id }),
    LocalStore
};

provide('stores', stores);
provide('config', config);
</script>
