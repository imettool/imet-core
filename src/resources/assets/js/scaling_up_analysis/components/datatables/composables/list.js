/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

import {ref} from "vue";

export function useList(component_data) {

    const sortBy = ref(component_data.sortBy || null);
    const sortDir = ref(component_data.sortDir || 'asc');
    const initial = ref(component_data.initial || null);

    function sortList(items) {
        return sortBy.value !== null
            ? sorter(items)
            : items;
    }

    function sort(sort_by_param, sort_dir_param = null){

        if(sort_by_param === sortBy.value && sort_dir_param === null) {
            sortDir.value = sortDir.value==='asc' ? 'desc' : 'asc';
        } else if(sortDir.value !== sort_dir_param){
            sortDir.value = sort_dir_param;
        }
        sortBy.value = sort_by_param;
    }

    function sorter(data) {
        return [...data].sort(function (a, b) {
            let dir = sortDir.value === 'asc' ? 1 : -1;
            let text_a = getAttribute(a, sortBy.value);
            let text_b = getAttribute(b, sortBy.value);
            if (typeof text_a !== "undefined" && typeof text_b !== "undefined") {
                if (typeof text_a === 'string') {
                    if (text_a.toString().toLowerCase() > text_b.toString().toLowerCase()) {
                        return dir;
                    }
                    if (text_a.toString().toLowerCase() < text_b.toString().toLowerCase()) {
                        return -1 * dir;
                    }
                } else {
                    if (parseInt(text_a, 10) > parseInt(text_b, 10)) {
                        return dir;
                    }
                    if (parseInt(text_a, 10) < parseInt(text_b, 10)) {
                        return -1 * dir;
                    }
                }
            }
            return 0;
        });
    }

    function sort_icon(selected_item = '') {

        if (sortBy.value === selected_item && sortDir.value === 'asc') {
            return 'fa fa-arrow-up';
        }

        if (sortBy.value === selected_item && ['desc', null].includes(sortDir.value)) {
            return 'fa fa-arrow-down';
        }

        return '';
    }

    function filterList(items) {
        items = filterByInitial(items);
        return items;
    }

    function filterByInitial(items) {
        if (initial.value !== null) {
            items = items.filter((item) => {
                if (item.name.charAt(0).toLowerCase() === initial.value.toLowerCase()) {
                    return true;
                }
            });
        }
        return items;
    }

    function filterByAttribute(items, filter_value, filter_on) {
        filter_value = filter_value === "" || filter_value === 'null' ? null : filter_value;
        if (filter_value !== null) {
            items = items.filter((item) => {
                let value = getAttribute(item, filter_on);
                if (value.toString().toLowerCase() === filter_value.toString().toLowerCase()) {
                    return true;
                }
            });
        }
        return items;
    }

    function getAttribute(item, attribute) {

        let value = null;

        /* More than 1 level deep */
        if (attribute.includes('.')) {
            let path = attribute.split('.');
            value = item;
            for (let i = 0; i < path.length; ++i) {
                value = value.hasOwnProperty(path[i]) ? value[path[i]] : '';
            }
        }
        /* simple attribute */
        else {
            value = item[attribute];
        }

        value = value === null ? '' : value;

        return value;
    }

    function calculateAverage (items) {

        const not_average_items = items.filter((item) => item['name'] !== 'Average')
        const averageItem = items.find((item) => item['name'] === 'Average');
        const averageItems = [];
        if (averageItem && not_average_items.length > 0) {
            const averageObj = Object.keys(averageItem).reduce((obj, key) => {
                obj[key] = 0;
                averageItems[key] = 0;
                return obj;
            }, {});

            not_average_items.map((o, x) => {
                const keys = Object.keys(o);
                keys.forEach((v, k) => {
                    if (v !== 'name') {
                        if (o[v] !== '-') {
                            averageObj[v] += o[v]
                            averageItems[v]++;
                        }
                    } else {
                        averageObj[v] = "Average";
                    }
                })
                return o;
            });
            const keys = Object.keys(averageObj);
            keys.forEach((v, k) => {
                if (v !== 'name') {
                    if (averageItems[v] > 0) {
                        averageObj[v] = parseFloat((averageObj[v] / averageItems[v]).toFixed(1));
                    } else {
                        averageObj[v] = '-';
                    }

                }
            })
            not_average_items.push(averageObj);
        }

        if (items.length === 1 && not_average_items.length === 0) {
            return items;
        }

        return not_average_items;
    }

    function get_value (value) {
        if (value === "-") {
            return "";
        }
        return value;
    }

    function itemLabel(value) {
        if (value === 'Average') {
            value = "* " + value;
        }
        if (value === "-") {
            return "";
        }
        return value;
    }

    function score_class (value, additional_classes = '') {
        let add_class = '';

        if ([null, "-"].includes(value)) {
            add_class = 'score_no';
        } else if (value <= -51) {
            add_class = 'score_danger_alert';
        } else if (value < -33 && value > -51) {
            add_class = 'score_danger_warning';
        } else if (value <= 0) {
            add_class = 'score_danger';
        } else if (value > 0 && value < 34) {
            add_class = 'score_alert';
        } else if (value < 51) {
            add_class = 'score_warning';
        } else {
            add_class = 'score_success';
        }
        return `${add_class} ${additional_classes}`;
    }

    function customization(values, columns) {
        let items = [];
        Object.entries(values).forEach(([key, value]) => {
            const object = {};
            columns.forEach((value2) => {

                if (value[value2.field] !== 'undefined') {
                    if (value2['type'] && value2['type'] === 'percentage') {
                        object[value2.field] = percentage(value[value2.field], value2.color);
                    } else if (value2['type'] && value2['type'] === 'color') {
                        object[value2.field] = colorArea(value[value2.field]);
                    } else if (value2['type'] && value2['type'] === 'bg-color') {
                        object[value2.field] = colorArea(value['color'], value[value2.field]);
                    } else if (value2['type'] && value2['type'] === 'value_in_area_with_color') {
                        object[value2.field] = colorArea(value2.color, value[value2.field]);
                    } else {
                        object[value2.field] = value[value2.field];
                    }
                }
            });
            items.push(object);
        })

        return items;
    }

    function percentage(value, color) {
        return `${value} <br/><div class="progress"><div class="progress-bar" style="width: ${value}%; background-color: ${color}"></div></div>`;
    }

    function colorArea(color, value = '') {
        return `<div class="p-3 mb-2 " style="background-color: ${color}">${value}</div>`;
    }

    function parse_data(selected = null, items, columns, values_with_indicators_keys) {

        const values = Object.entries({...items});
        const data = [];
        values.forEach((value, idx) => {
            if ((selected !== null && selected[value[0]]) || (selected === null && value[1]?.legend_selected)) {
                const item = {};
                columns.forEach((column, idx) => {
                    if (!["color", "name"].includes(column['field'])) {
                        if (values_with_indicators_keys) {
                            item[column['field']] = value[1][column['field']];
                        } else {
                            item[column['field']] = value[1][idx - 1];
                        }
                    }
                })
                data.push({
                    name: value[0],
                    ...item,
                    color: value[1]['color']
                })
            }
        });
        return data;
    }

    return {
        parse_data,
        sortList,
        filterByAttribute,
        sort_icon,
        score_class,
        itemLabel,
        get_value,
        calculateAverage,
        customization,
        percentage,
        colorArea,
        filterList,
        sort
    }

}
