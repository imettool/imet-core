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
        <div class="img-fluid" v-for="(item, idx) in items" :id="'image-content' + idx" :key="idx">
            <div>
                <img @load="imageLoaded(idx)" :src="item" :id="idx" />
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, watch, onMounted } from "vue";
import basket_store from "../../stores/basket.store.js";

const props = defineProps({
    scaling_up_id: {
        type: [String, Number],
        default: ''
    }
});

const items = ref([]);
const pixels_page = ref(0);
const images = ref([]);

onMounted(async () => {
    await printElement();
})

watch(images.value, (val, oldVal) => {
    if (val.length === items.length) {
        isHeightEnough();
    }
}, { deep: true })

function imageLoaded(id) {
    images.value.push(id);
}

function isHeightEnough() {
    items.value.forEach((item, id) => {
        const img = document.getElementById(`${id}`);
        pixels_page.value += img.height;

        if (pixels_page.value > 1200 && pixels_page.value < 1500) {
            const div = document.getElementById('image-content' + (id));
            div.className = "content";
            pixels_page.value = 0;
        } else if (pixels_page.value > 1500) {
            const div = document.getElementById('image-content' + (id - 1));
            div.className = "content";
            pixels_page.value = 0;
        }
    })
}

async function printElement() {
    const BasketStore = new basket_store({ scaling_up_id: props.scaling_up_id })
    const all = await BasketStore.retrieve_all();

    all.forEach(item => {
        items.value.push('/' + item.item);
    })
}

</script>
