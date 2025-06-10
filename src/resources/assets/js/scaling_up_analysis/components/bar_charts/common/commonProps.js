/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

export const common = {
    width: {
        type: String,
        default: "100%"
    },
    height: {
        type: String,
        default: "500px"
    },
    values: {
        type: [Array, Object],
        default: () => {}
    },
    colors: {
        type: [Array, Object],
        default: null
    },
    axis_dimensions_x: {
        type: Object,
        default: () => {}
    },
    axis_dimensions_y: {
        type: Object,
        default: () => {}
    },
    title: {
        type: String,
        default: ""
    }
}


export const commonProps = {
    fields: {
        type: Array,
        default: () => {
        }
    },
    rotate: {
        type: Number,
        default: 0
    },
    zoom: {
        type: Boolean,
        default: false
    },
    series_data: {
        type: Object,
        default: () => {
        }
    },
    title_data: {
        type: String,
        default: ''
    }
};
