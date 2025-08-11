/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

import {createApp, ref, onMounted, watch, nextTick, reactive, toRaw} from "vue";
import selectorWdpa from "../inputs/selector-wdpa.vue";
import selectorUser from "../inputs/selector-user.vue";
import dropDown from "@modular-forms/js/inputs/dropdown.vue";
import selectorDialog from "@modular-forms/js/inputs/components/selector-dialog.vue";
import dialogBox from "@modular-forms/js/templates/dialog_box.vue";


export default class Roles {

    constructor(input_data = {}) {

        const options = {
            name: 'Roles',
            setup() {
                let records = reactive(input_data.records);
                let records_backup = JSON.parse(JSON.stringify(toRaw(records)));
                const status = ref('init'); // "init" state avoid watch() on records during initialization
                let warning_on_save = null;


                function ensureLastEmpty() {
                    if (status.value === 'init' && records.length === 0 && input_data.empty_record !== undefined) {
                        records.push(input_data.empty_record);
                        console.log('Adding empty record', records);
                    }

                }

                function saveModule() {
                    debugger;
                    status.value = 'saving';
                    let form = document.querySelector('#roles-form');
                    let url = form.getAttribute('action');
                    let method = form.getAttribute('method');
                    let role_type = document.getElementById('role_type').value;
                    let form_data = new FormData(form);
                    form_data.append('records', window.ModularForms.Helpers.Payload.encode(input_data.records));
                    let data = {
                        records: window.ModularForms.Helpers.Payload.encode(records),
                        role_type,
                        _method: form.getAttribute('method')
                    }

                    fetch(url, {
                        method: method,
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-Token": window.Laravel.csrfToken,
                        },
                        body: JSON.stringify(data),
                    })
                        .then((response) => response.json())
                        .then(function (data) {
                            console.log('Success:', data);
                            nextTick().then(() => {
                                status.value = 'saved';
                            });
                        })
                        .catch(function (error) {
                            status.value = 'error';
                            console.error('Error:', error);
                        });
                }

                function deleteItem(event) {
                    let clicked_button = event.target;
                    let row = clicked_button.closest('tr.module-table-item');
                    let row_index = row.rowIndex;
                    input_data.records.splice(row_index, 1);
                }

                ensureLastEmpty();

                watch(records, (value) => {

                    if (status.value !== 'init' && status.value !== 'changed'){
                        console.log({value, status:status.value});
                        status.value = 'changed';
                    }
                });

                onMounted(() => {
                    ensureLastEmpty();
                    status.value = 'idle';
                });

                console.log(records);
                return {
                    deleteItem,
                    saveModule,
                    ensureLastEmpty,
                    records,
                    status,
                    test:'testtt'
                }
            }
        }

        const app = createApp(
            options || {},
            input_data || {}
        );

        // Register components
        app.component('selector-wdpa', selectorWdpa);
        app.component('selector-user', selectorUser);
        app.component('selector-dialog', selectorDialog);
        app.component('dialog-box', dialogBox);
        app.component('dropdown', dropDown);

        return app;
    }

}
