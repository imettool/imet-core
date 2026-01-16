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

use Exception;
use ImetCore\Models\Country;
use ModularForms\Helpers\Template as BaseTemplate;

class Template
{
    /**
     * Return country flag from ISO (with optional name)
     *
     * @throws Exception
     */
    public static function flag(string $iso, bool $with_name = false): string
    {
        if ($iso !== '') {
            $country = Country::getByISO($iso);
            $iso = $country->iso2;
            $label = '&nbsp;'.$country->name;

            return $with_name
                ? BaseTemplate::flag($iso, $country->name).$label
                : BaseTemplate::flag($iso);
        }

        return '';
    }

    /**
     * Return scope icon (marine or terrestrial)
     */
    public static function module_scope(?string $scope): string
    {
        if ($scope !== null) {
            return "<scope-icon scope='".$scope."'></scope-icon>";
        }

        return '';
    }
}
