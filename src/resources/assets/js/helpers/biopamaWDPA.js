/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

export default{

    vectorTileLayer(map, wdpa_ids = null, color = null){

        // Add source: JRC geoserver
        map.addSource("geospatial_jrc", {
            type: 'vector',
            tiles: [
                'https://geospatial.jrc.ec.europa.eu/geoserver/gwc/service/wmts?' +
                'layer=marxan:wdpa_latest_biopama' +
                '&tilematrixset=EPSG:900913' +
                '&Service=WMTS' +
                '&Request=GetTile' +
                '&Version=1.0.0' +
                '&Format=application/x-protobuf;type=mapbox-vector' +
                '&TileMatrix=EPSG:900913:{z}' +
                '&TILECOL={x}' +
                '&TILEROW={y}'
            ],
            'tileSize': 512,
            'scheme': 'xyz',
        });

        color = color || [
            "match",
            ["get", "marine"],
            ["0"],
            "rgba(141, 191, 79, 0.7)",
            "rgba(104, 156, 150, 0.7)"
        ];

        // Add layer: wdpa_latest_biopama
        map.addLayer({
            "id": "biopama_wdpa",
            "type": "fill",
            "source": "geospatial_jrc",
            "source-layer": 'wdpa_latest_biopama',
            "minzoom": 2,
            "paint": {
                "fill-color": color
            }
        });

        // Filter by wdpa_ids
        if(wdpa_ids !== null) {
            wdpa_ids = typeof wdpa_ids === 'string' ? wdpa_ids.split(',') : wdpa_ids;
            wdpa_ids = wdpa_ids
                .map(function (item) {
                    return parseInt(item)
                });
            map.setFilter("biopama_wdpa", ['in', 'wdpaid'].concat(wdpa_ids));
        }

    }

}