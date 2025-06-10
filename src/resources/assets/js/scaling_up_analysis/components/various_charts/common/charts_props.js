/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

export const commonProps = {
    title: {
        type: String,
        default: ''
    },
    width: {
        type: Number,
        default: 180
    },
    height: {
        type: Number,
        default: 180
    },
    values: {
        type: Object,
        default: () => {
        }
    },
    indicators: {
        type: [Array, Object],
        default: () => {
        }
    },
    show_legends: {
        type: Boolean,
        default: false
    },
    single: {
        type: Boolean,
        default: true
    },
    showOnlyScaling: {
        type: Boolean,
        default: false
    },
    unselect_legends_on_load: {
        type: Boolean,
        default: false
    },
    radar_indicators_for_negative: {
        type: Array,
        default: () => {
            return [];
        }
    },
    radar_indicators_for_zero_negative: {
        type: Array,
        default: () => {
            return [];
        }
    },
    always_first_in_legend: {
        type: Array,
        default: () => {
            return [0, 1, 2];
        }
    },
    refresh_average: {
        type: Boolean,
        default: true
    },
    event_key: {
        type: String,
        default: ''
    }
  };
