<!--
  - Copyright (C) 2025 European Union
  - This program is free software: you can redistribute it and/or modify it under the terms of the
  - EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
  - This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
  - warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
  - further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
  - If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
  -->

<template></template>
<script setup>
import { inject } from 'vue'
import { useHtmlToImage } from "../composables/html_to_image";

const props = defineProps({
    element: {
        type: String,
        default: ''
    },
    exclude_elements: {
        type: String,
        default: null
    },
    event_id: {
        type: String,
        default: 'save_image'
    }
});

const emitter = inject('emitter');


const {
    htmlToImage
} = useHtmlToImage(props, emitter);
</script>
