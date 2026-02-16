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

    setupApp(props, input_data) {
        let setup_obj = super.setupApp(props, input_data);
        let group_key_field = props.group_key_field;
        let empty_record = props.empty_record;
        let groups = reactive(props.groups);

        delete setup_obj.replaceGroups;
        delete setup_obj.addItem;

        setup_obj.emitter.off('moduleSaved');

        setup_obj.emitter.on('moduleSaved', (data) => {
            replaceGroups(data.groups);
        });

        function replaceGroups(newGroups) {
            Object.keys(groups).forEach(key => {
                delete groups[key];
            });
            Object.keys(newGroups).forEach(key => {
                groups[key] = newGroups[key];
            });
        }

        function ensureAteLeastOneRecordPerGroup() {
            let used_groups = setup_obj.records.map(record => record[group_key_field]);
            let missing_groups = Object.keys(groups).filter(n => !used_groups.includes(n));
            missing_groups.forEach(group_key => {
                addItem(group_key);
            });
        }

        function updateGroupKey(index, new_group_key) {
            groups[index]['GroupKey'] = new_group_key;
        }

        function recordsFilterKeepIndex(records, index1, index2) {
            return setup_obj.records.map((i, d) => {
                i.index = d;
                return i;
            }).filter(r => {
                return setup_obj.recordIsInGroup(r, index1[group_key_field]) || setup_obj.recordIsInGroup(r, index1['GroupKey'])
            }).slice(0, 1)
        }

        function accordionTitle(index) {
            return groups[index]['GroupKey'];
        }

        function addItem(group_key, stakeholder) {
            let new_empty_record = JSON.parse(JSON.stringify(toRaw(empty_record)));
            setup_obj.records.find(r => r[group_key_field] === group_key);
            new_empty_record[group_key_field] = group_key;
            setup_obj.records.push(new_empty_record);
        }

        function deleteItem(index){
            let num_records= setup_obj.numRecordsInGroup(setup_obj.records[index][group_key_field])
            if(num_records > 1){
                setup_obj.records.splice(index, 1);
            } else {
                let new_empty_record = JSON.parse(JSON.stringify(empty_record));
                new_empty_record[group_key_field] = setup_obj.records[index][group_key_field];
                setup_obj.records[index] = new_empty_record;
            }
        }


        ensureAteLeastOneRecordPerGroup();

        return {
            ...setup_obj,
            updateGroupKey,
            recordsFilterKeepIndex,
            accordionTitle,
            groups,
            addItem,
            deleteItem
        };

    }

}
