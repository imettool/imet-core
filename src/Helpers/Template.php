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

use ImetCore\Models\Country;
use ModularForms\Helpers\Template as BaseTemplate;

class Template
{
    /**
     * Return country flag + name from ISO
     *
     * @throws \Exception
     */
    public static function flag_and_name($iso): string
    {
        if ($iso != '') {
            $country = Country::getByISO($iso);
            $iso = $country->iso2;
            $label = '&nbsp;'.$country->name;

            return BaseTemplate::flag($iso, $country->name).$label;
        }

        return '';
    }

    /**
     * Return country flag from ISO
     *
     * @throws \Exception
     */
    public static function flag($iso): string
    {
        if ($iso != '') {
            $country = Country::getByISO($iso);
            $iso = $country->iso2;

            return BaseTemplate::flag($iso);
        }

        return '';
    }

    /**
     * Return scope icon (marine or terrestrial)
     */
    public static function module_scope($scope): string
    {
        if ($scope !== null) {
            return "<scope-icon scope='".$scope."'></scope-icon>";
        }

        return '';
    }
}
