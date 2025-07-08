/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

import {createApp, ref, computed} from 'vue';

export default class ExportApp {
    constructor(input_data = {}) {

        const options = {

            name: 'ExportApp',
            setup() {
                const checkboxes = ref([]);
                const status = ref('idle');
                const list = ref(input_data.list || []);
                const isCheckAll = ref(false);
                const exportDisabled = ref(true);

                const items = computed(() => {
                    return list.value;
                });

                const totalCount = computed(() => {
                    return list.value.length;
                });

                function exportToggle() {
                    exportDisabled.value = checkboxes.value.length === 0;
                }

                function checkAll() {
                    if (!isCheckAll.value) {
                        for (const item in list.value) {
                            checkboxes.value.push(list.value[item].FormID);
                        }
                    } else {
                        checkboxes.value = [];
                    }
                    exportDisabled.value = checkboxes.value.length === 0;
                }

                return {
                    checkboxes,
                    status,
                    isCheckAll,
                    exportDisabled,
                    items,
                    totalCount,
                    exportToggle,
                    checkAll
                };
            }
        }

        return createApp(
            options || {},
            input_data || {}
        );
    }
}
