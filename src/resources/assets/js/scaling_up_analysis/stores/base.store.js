/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

export default class BaseStore {

    constructor(args) {
        this.protected_areas = null;
        this.is_country = null;
        this.scaling_up_id = args.scaling_up_id;
        this.init();
    }

    init() {

    }

    get_scaling_up(){
        return this.scaling_up_id;
    }

    is_country_enabled() {
        return this.is_country;
    }

    toggle_country_enabled() {
        return this.is_country != this.is_country;
    }

    find_config_by_name(config, name) {
        const items = config.find(item => item.name === name);
        return items;
    }

    add_color_to_value(values, id, colors) {
        const color_items = [];
        const items = Object.values(values);
        items.forEach(item => {
            const color = colors.filter(c => c[id])
            color_items.push({value: item, itemStyle: {color: color[0][id]}});
        })
        return color_items;
    }

    add_color_to_value_by_cat(values, id, indicators, colors) {
        const items = Object.values(values.Average);
        return items;
    }

    add_color_to_value_rel(values, colors) {
        if (!values.Average) {
            return {};
        }
        const items = Object.values(values.Average);
        items.forEach((item, idx) => {
            values.Average[idx] = {
                value: item['value'],
                'upper limit': item['upper limit'],
                itemStyle: {color: colors[idx]}
            };
        });
        const result = {'Average': Object.keys(values.Average).map((k) => values.Average[k])};

        return result
    }

    parse_indicators(indicators) {
        return Object.values(indicators);
    }

    is_visible(values) {
        if (typeof values === 'undefined') {
            return false;
        }
        return Object.keys(values).length;
    }

    localization(value) {
        return window.ModularForms.Helpers.Locale.getLabel(value);
    }
}
