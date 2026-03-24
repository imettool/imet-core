/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

import ModuleImet from "../../../Module.js";

import {reactive, toRaw} from "vue";


export default class WorkProgramImplementation extends ModuleImet {

    constructor(input_data = {}) {

        const custom_props = {
            original_group_key_field: String
        }
        super(input_data, custom_props);
    }

    setupApp(props, input_data) {

        let setup_obj = super.setupApp(props, input_data);
        let group_key_field = props.group_key_field;
        let original_group_key_field = props.original_group_key_field;
        let empty_record = props.empty_record;
        let groups = reactive(props.groups);

        function isGroupDefined(group_key) {
            return groups[group_key] !== undefined && groups[group_key] !== null;
        }

        /**
         * Refresh the value of a group key in the groups object. The key is unchanged, only the value is updated.
         */
        function refreshGroupKey(group_key, new_value) {
            // Update the value in the groups object
            groups[group_key] = new_value;
            // Update the value in all the group records
            setup_obj.records.forEach(record => {
                if (record[group_key_field] === group_key) {
                    record[original_group_key_field] = new_value;   // Update the original group key field with the new value
                }
            });
        }

        /**
         * Filter records by group key, but keep the original index of the record in the main records array (setup_obj.records)
         */
        function recordsFilterKeepIndex(group_key) {
            return setup_obj.records
                .map((i, d) => {
                    i.__index = d;
                    return i;
                })
                .filter(r => r[group_key_field] === group_key)
                .slice(0, 1)
        }

        /**
         * Override: generate the accordion title by taking it from the groups object
         */
        function accordionTitle(group_key) {
            let index = Object.keys(groups).indexOf(group_key) + 1;
            let title = groups[group_key] !== null  ? groups[group_key] : '';
            return index.toString() + ' - ' + title;
        }

        /**
         * Override: add group key and original group key values to the new record when adding a new item
         */
        function addItem(group_key) {
            let new_empty_record = JSON.parse(JSON.stringify(toRaw(empty_record)));
            let original_group_value = setup_obj.records.find(r => r[group_key_field] === group_key)[original_group_key_field]
            new_empty_record[group_key_field] = group_key;
            new_empty_record[original_group_key_field] = original_group_value;
            setup_obj.records.push(new_empty_record);
        }

        /**
         * Override: use __index to remove the correct item from the records
         */
        function deleteItem(index){
            let num_records = setup_obj.records.length;
            let item_to_delete = setup_obj.records.find(r => r['__index'] === index);
            let group_key = item_to_delete[group_key_field];
            let record_index = item_to_delete['__index'];

            if(num_records > 1){
                setup_obj.records.splice(record_index, 1);
            } else {
                let new_empty_record = JSON.parse(JSON.stringify(empty_record));
                new_empty_record[group_key_field] = group_key;
                setup_obj.records[record_index] = new_empty_record;
            }
        }

        return {
            ...setup_obj,
            isGroupDefined,
            refreshGroupKey,
            recordsFilterKeepIndex,
            accordionTitle,
            addItem,
            deleteItem
        };

    }

}
