/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

import {createApp, ref, provide} from "vue";
import previewTemplate from "./components/layouts/preview-template.vue";
import application from './components/app.vue';

import mitt from "~/mitt";

export default class Preview {

    constructor(input_data = {}) {

        window.ImetPreview = {
            printReport: () => {
                window.print();
            },
            downloadFiles: () => {
                window.location.href = input_data.url;
            }
        };

        const options = {
            name: 'Preview',
            setup() {
                const emitter = mitt();
                provide('emitter', emitter);
                const printReport = () => {
                    window.ImetPreview.printReport();
                };

                const downloadFiles = () => {
                    window.ImetPreview.downloadFiles();
                };

                return {
                    printReport,
                    downloadFiles
                }
            }

        }

        const app = createApp(
            options || {},
            input_data || {}
        );

        app.component('app',    application);
        // Register components
        app.component('preview-template', previewTemplate);

        return app;
    }
}
