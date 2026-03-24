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

use Illuminate\Support\Str;
use ImetCore\Models\Country;
use ImetCore\Models\Currency;
use ImetCore\Models\ProtectedArea;
use ModularForms\Helpers\Input\SelectionList as ModularFormsSelectionList;
use Override;

class SelectionList extends ModularFormsSelectionList
{
    #[Override]
    public static function getList(string $type): array
    {
        $type = static::getListType($type);

        if (Str::startsWith($type, 'ImetV1')
            || Str::startsWith($type, 'ImetV2')
            || Str::startsWith($type, 'Imet_')
            || Str::startsWith($type, 'OECM_')
            || Str::startsWith($type, 'ImetOECM_')
            || Str::startsWith($type, 'ImetOecm_')
        ) {
            preg_match("/Imet([\w\d]{0,2}|[\w\d]{0,4})\_([\w]+)/", $type, $matches);

            if ($matches[2] == 'ProtectedArea') {
                return ProtectedArea::selectionList();
            } elseif ($matches[2] == 'Country') {
                return Country::selectionList();
            } elseif ($matches[2] == 'PaCountry') {
                return ProtectedArea::getCountries()
                    ->sortBy(Country::labelKey())
                    ->pluck(Country::labelKey(), 'iso3')
                    ->toArray();
            } elseif ($matches[2] == 'Currency') {
                return Currency::selectionList();
            } elseif ($matches[2] == 'PaType') {
                return [
                    'terrestrial' => trans('imet-core::oecm_lists.PaType.terrestrial'),
                    'marine_and_coastal' => trans('imet-core::oecm_lists.PaType.marine_and_coastal'),
                    'mixed' => trans('imet-core::oecm_lists.PaType.mixed'),
                ];
            }

            // Fallback to lang lists:
            // $matches[1] = V1, V2, OECM
            // $matches[2] = list name
            elseif ($matches[1] != '') {
                return trans('imet-core::'.strtolower($matches[1]).'_lists.'.$matches[2]);
            }

        }

        return parent::getList($type);
    }
}
