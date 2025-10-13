<?php

/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

namespace ImetCore\Helpers;

class Manifest
{
    /**
     * Retrieve hashed assets path from manifest file
     */
    public static function asset($hashed_asset, $debug = false): string
    {
        $asset_path = '/vendor/imet-core/';
        $path = public_path($asset_path);

        $manifest_path = $path.'manifest'.($debug ? '-debug' : '').'.json';
        $manifest = json_decode(file_get_contents($manifest_path), true);

        if (! isset($manifest[$hashed_asset])) {
            return $asset_path.$hashed_asset;
        }

        return $asset_path.$manifest[$hashed_asset];
    }
}
