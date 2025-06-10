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

export function useBar(component_data) {
    const zoom = component_data.zoom;
    const colors = component_data.colors;
    const fields = component_data.fields;

    function has_zoom() {
        if (zoom) {
            return {
                dataZoom: [
                    {
                        show: true,
                        start: 0,
                        end: 100
                    }
                ]
            }
        }
        return {};
    }

    function get_colors() {
        if (colors === null) {
            return {};
        }
        return {colors}
    }

    function field_name() {
        return fields.map(field => {
            return field;
        })
    }


    return {
        has_zoom,
        get_colors,
        field_name
    }
}
