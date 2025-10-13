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

namespace ImetCore\Controllers\Imet\Traits;

use Illuminate\Support\Str;
use ImetCore\Models\Imet\Imet as ImetAlias;
use ImetCore\Models\Imet\v1\Imet;
use ImetCore\Models\Imet\v1\Imet_Eval;
use ImetCore\Models\Imet\v1\Modules;
use ImetCore\Models\ProtectedAreaNonWdpa;

trait ConvertSQLite
{
    /**
     * Convert IMET
     */
    public static function convert($imet, $sqlite_connection): array
    {
        // skip if test
        if ($imet->Country === 'AWY') {
            return [];
        }

        // Retrieve WDPAID
        [$wdpa, $pa_name] = Modules\Component\ImetModule::identifySqlitePa($imet, $sqlite_connection);

        // no WDPA nor NAME found: cannot identify
        if (blank($wdpa) && blank($pa_name)) {
            return [];
        }

        // Non-WDPA protected area
        $wdpa = filled($wdpa) ? $wdpa : ProtectedAreaNonWdpa::generate_fake_wdpa();

        // Build JSON structure
        $json = [
            'Imet' => [
                'name' => $pa_name,
                'Country' => $imet->Country,
                'Year' => $imet->Year,
                'version' => ImetAlias::IMET_V1,
                'wdpa_id' => trim($wdpa),
                'language' => Str::lower($imet->FormLanguage),
                'imet_version' => 'SQLITE',
            ],
            'Encoders' => [],
            'Context' => [],
            'Evaluation' => [],
        ];
        if (ProtectedAreaNonWdpa::isNonWdpa($wdpa)) {
            $json['NonWdpaProtectedArea'] = [];
            $json['NonWdpaProtectedArea']['id'] = $wdpa;
            $json['NonWdpaProtectedArea']['wdpa_id'] = trim($wdpa);
            $json['NonWdpaProtectedArea']['name'] = $pa_name;
            $json['NonWdpaProtectedArea']['country'] = $imet->Country;
        }

        foreach (Imet::allModules() as $module_class) {
            $json['Context'][$module_class::getShortClassName()] = $module_class::convert($imet, $sqlite_connection);
        }
        foreach (Imet_Eval::allModules() as $module_class) {
            $json['Evaluation'][$module_class::getShortClassName()] = $module_class::convert($imet, $sqlite_connection);
        }

        return $json;
    }
}
