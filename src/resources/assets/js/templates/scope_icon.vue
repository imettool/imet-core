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

    <template v-if="scope===TERRESTRIAL_AND_MARINE || scope===TERRESTRIAL">
        <img style="height: 28px;" :src=terrestrialIcon class="inline mr-2" />
        <tooltip>{{ Locale.getLabel('imet-core::common.terrestrial') }}</tooltip>
    </template>

    <template v-if="scope===TERRESTRIAL_AND_MARINE || scope===MARINE">
        <img style="height: 28px;" :src=marineIcon class="inline mr-2" />
        <tooltip>{{ Locale.getLabel('imet-core::common.marine') }}</tooltip>
    </template>


</template>


<script setup>

import marineIcon from "../../images/fish.png";
import terrestrialIcon from "../../images/tree.png";

const Locale = window.ModularForms.Helpers.Locale;

const props = defineProps({
    scope :  {
        type: String,
        default: null
    }
});

const TERRESTRIAL_AND_MARINE = 'terrestrial_and_marine';
const TERRESTRIAL = 'terrestrial';
const MARINE = 'marine';

</script>