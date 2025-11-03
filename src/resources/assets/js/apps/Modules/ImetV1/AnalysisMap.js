/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

import { createApp, onMounted } from "vue";
import maplibregl from 'maplibre-gl';
import 'maplibre-gl/dist/maplibre-gl.css';
import BiopamaWDPA from './../../../helpers/biopamaWDPA';
import Map from './../../../helpers/map';

export default class AnalysisMap {

    constructor(input_data = {}, custom_props = {}) {
        let _this = this;

        const options = {
            name: 'AnalysisMap',
            props: {
                wdpa_id: [String, Number],
            },
            setup(props) {
                return _this.setupApp(props);
            }
        }

        return this.createApp(options, input_data);
    }

    setupApp(input_data) {

        onMounted(() => {
            loadMap();
        });


        function loadMap() {

            const report_map = new maplibregl.Map({
                container: 'map',
                style: Map.openstreetmap,
                center: [30, 0],
                zoom: 4,
                minZoom: 2,
                maxZoom: 12,
                attributionControl: false
            });

            report_map.on('load', function () {
                BiopamaWDPA.vectorTileLayer(report_map, input_data.wdpa_id);
            });
        }

        return {}
    }

    createApp(options, input_data) {

        return createApp(options, input_data);
    }
}
