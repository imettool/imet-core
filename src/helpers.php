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

use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

/**
 * Check if the current environment is IMET related (ex. Imet Offline Tool or imetglobal)
 */
function is_imet_environment(): bool
{
    return Str::contains(App::environment(), 'imet')
        || is_imet_offline_tool();
}

/**
 * Check if the current environment is the IMET Offline Tool
 */
function is_imet_offline_tool(): bool
{
    return function_exists('imet_offline_tool_version');
}

/**
 * Check if the current environment is the development env of IMET Global Tool
 */
function is_imet_global_dev(): bool
{
    return App::environment('imetglobal_dev');
}

/**
 * Imet selection lists
 *
 * @param string $type
 * @return array
 */
function imet_selection_lists(string $type): array
{
    $list = [];

    if (Str::startsWith($type, 'ImetV1')
        || Str::startsWith($type, 'ImetV2')
        || Str::startsWith($type, 'Imet_')
        || Str::startsWith($type, 'OECM_')
        || Str::startsWith($type, 'ImetOECM_')) {
        preg_match("/Imet([\w\d]{0,2}|[\w\d]{0,4})\_([\w]+)/", $type, $matches);

        if ($matches[2] == "ProtectedArea") {
            $list = \ImetCore\Models\ProtectedArea::selectionList();
        } elseif ($matches[2] == "Country") {
            $list = \ImetCore\Models\Country::selectionList();
        } elseif ($matches[2] == "Currency") {
            $list = \ImetCore\Models\Currency::imetV1List();
        } elseif ($matches[1] != "") {

            $list = trans('imet-core::' . strtolower($matches[1]) . '_lists.' . $matches[2]);
        }

    }

    return $list;
}
