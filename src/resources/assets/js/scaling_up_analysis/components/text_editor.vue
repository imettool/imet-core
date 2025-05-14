<template>
    <div>
        <div class="text-editor-edit">
            <div class="field-edit" ref="textEditorComponent"></div>
        </div>
        <div class="text-editor-print" v-html=editorData></div>
    </div>
</template>


<style lang="postcss" scoped>
.text-editor-edit {
    @media print {
        display: none;
    }
}
.text-editor-edit, .ql-container{
    max-width: 800px;
}

.text-editor-print {
    background-color: white !important;
    padding: 15px;

    @media screen {
        display: none;
    }
}
</style>
<style>
.ql-toolbar{
    background: white;
}
</style>

<script setup>
import { ref, watch, inject, onMounted } from 'vue';
import Quill from 'quill';
import Bold from 'quill/formats/bold';
import Italic from 'quill/formats/italic';
import Link from 'quill/formats/link';
import List from 'quill/formats/list';
import Header from 'quill/formats/header';

import "quill/dist/quill.core.css";
import "quill/dist/quill.snow.css";

const props = defineProps({
    value: { type: String, default: '' },
    save_data: { type: Boolean, default: false },
    event_id: { type: String, default: 'save_comments' }
});

const emitter = inject('emitter');


const editorData = ref('');
const textEditorComponent = ref(null);

let quill = null;
const options = {
    modules: {
        toolbar: [
            ['bold', 'italic'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            ['link'],
            [{ header: [2, false] }],
        ],
    },
    theme: 'snow'
};

watch(() => props.value, (newValue) => {
    if (newValue !== editorData.value) {
        editorData.value = newValue;
    }
});

onMounted(() => {
    quill = new Quill(textEditorComponent.value, options);
    quill.on('text-change', () => {
        editorData.value = quill.container.querySelector('.ql-editor').innerHTML;
    });
    emitter.on('save_comments', (func, attr) => {
        func(editorData.value || '', attr);
    });
});

</script>
