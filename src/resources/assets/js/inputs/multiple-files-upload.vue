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

        <vue-dropzone
            ref="dropzoneComponent"
            id="dropzone"
            :options="dropZoneOptions"
            :useCustomSlot="true"
            v-on:vdropzone-error="uploadError"
            v-on:vdropzone-processing="processing"
            v-on:vdropzone-success="uploadedSuccessfully"
            v-on:vdropzone-file-added="fileAdded"
        >

            <div class="dropzone-custom-content">
                <h3 class="dropzone-custom-title">{{ Locale.getLabel('modular-forms::common.upload.multiple_files_description') }}</h3>
            </div>

        </vue-dropzone>
        <a class="btn-nav" v-show="files_added>0 && files_added===files_uploaded" :href=backUrl>
          {{ Locale.getLabel('modular-forms::common.go_back') }}
        </a>

</template>

<script setup>

import { ref } from "vue";
import vueDropzone from "~/dropzone-vue3";

const props = defineProps({
    uploadUrl: {
        type: String,
        default: null
    },
    backUrl:{
        type: String,
        default: null
    },
});

const Locale = window.ModularForms.Helpers.Locale;

const files_added = ref(0);
const files_uploaded = ref(0);
const formatTypes = ["application/json", "application/zip"];
const dropzoneComponent = ref(null);
const dropZoneOptions = {
    url: props.uploadUrl,
    previewTemplate:
        `<div class="dropzone-file-list text-sm">
            <div class="file-row">
                <div class="file-details">
                    <div class="name" data-dz-name></div>
                    <div class="size" data-dz-size></div>
                    <div class="dz-remove" data-dz-remove></div>
                    <div class="progress">
                        <div class="progress-bar total-progress" style="width:0;" data-dz-uploadprogress></div>
                    </div>
                </div>
            </div>
        </div>`,
    // previewTemplate:
    //     `<div class="files text-sm">
    //         <div class="file-row dz-preview dz-file-preview">
    //             <div class="dz-details">
    //                 <div class="dz-filename"><span data-dz-name></span></div>
    //                 <div class="dz-size" data-dz-size></div>
    //             </div>
    //             <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
    //             <div class="dz-success-mark"><span>✔</span></div>
    //             <div class="dz-error-mark"><span>✘</span></div>
    //             <div class="dz-error-message"><span data-dz-errormessage></span></div>
    //         </div>
    //     </div>`,
    params(files, xhr, chunk) {
        return {
            _token: window.Laravel.csrfToken
        };
    },
    addRemoveLinks: true,
    clickable: true,
    maxFiles: 20,
    maxFilesize: 150,
    timeout: 100000,
    acceptedFiles: ".json,.zip",
    autoProcessQueue: true,
    dictDefaultMessage: Locale.getLabel('imet-core::common.dropzone.dict_default_message'),
    dictFallbackMessage: Locale.getLabel('imet-core::common.dropzone.dict_fallback_message'),
    dictFallbackText: Locale.getLabel('imet-core::common.dropzone.dict_fallback_text'),
    dictFileTooBig: Locale.getLabel('imet-core::common.dropzone.dict_file_too_big')
        .replace('__filesize__', '{{filesize}}')
        .replace('__maxFilesize__', '{{maxFilesize}}'),
    dictInvalidFileType: Locale.getLabel('imet-core::common.dropzone.dict_invalid_file_type'),
    dictResponseError: Locale.getLabel('imet-core::common.dropzone.dict_response_error')
        .replace('__statusCode__', '{{statusCode}}'),
    dictCancelUpload: Locale.getLabel('imet-core::common.dropzone.dict_cancel_upload'),
    dictUploadCanceled: Locale.getLabel('imet-core::common.dropzone.dict_upload_canceled'),
    dictRemoveFile: Locale.getLabel('imet-core::common.dropzone.dict_remove_file'),
    dictMaxFilesExceeded: Locale.getLabel('imet-core::common.dropzone.dictMaxFilesExceeded'),
};

function progressBarConfiguration(file, label, color = 'blue', width = '100%') {
    const selector = file.previewTemplate.querySelector(".total-progress.progress-bar");
    selector.innerHTML = label;
    selector.style.backgroundColor = color;
    selector.style.color = "white";
    selector.style.width = width;
}

function fileAdded(file) {
    files_added.value++
}

function uploadError(file, message) {
    files_uploaded.value++;
    let errorMessage = Locale.getLabel('modular-forms::common.upload.upload_error');
    if (message['message']) {
        errorMessage += message['message'];
    } else if (!formatTypes.includes(file.type)) {
        errorMessage = Locale.getLabel('modular-forms::common.upload.not_valid_format');
    } else {
        errorMessage += message;
    }
    progressBarConfiguration(file, errorMessage, 'red', '100%');
}

function processing(file) {
    progressBarConfiguration(file, Locale.getLabel('modular-forms::common.upload.uploading'));
}

function uploadedSuccessfully(file, response) {
    files_uploaded.value++;
    let message = Locale.getLabel('modular-forms::common.upload.uploaded');
    if (response.length > 1) {
        let filesDidNotUploaded = 0;
        response.forEach((r => {
            if (r.status !== 'error') {
                filesDidNotUploaded++;
            }
        }))
        const totalFiles = response.length;
        message += Locale.getLabel('modular-forms::common.upload.not_all_imported').replace("{{filesDidNotUploaded}}", filesDidNotUploaded).replace("{{totalFiles}}", totalFiles);
    }
    progressBarConfiguration(file, message, "green");
}


</script>


<style>

#dropzone {
    display: inline-block;
    height: 300px;
    max-height:300px;
    overflow:auto;
    background:#fff;
    width: 100%;
}

.dropzone-file-list{
    display: flex;
    gap: 30px;

    .file-row{
        width: 100%;

        .file-details {
            flex-grow: 1;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: flex-start;
            gap: 15px;

            .progress{
                flex-grow: 1;
                border-radius: 4px;
                .progress-bar{
                    border-radius: 4px;
                    font-weight: bold;
                    padding: 3px 6px;
                }
            }

        }

    }

}

.dz-remove{
    display: none;
}

</style>
