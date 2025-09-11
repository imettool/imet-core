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

use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class ImetEnv {

    /**
     * Check if the current environment is IMET related (ex. Imet Offline Tool or IMET Global)
     */
    public static function isImetEnv(): bool
    {
        return Str::contains(App::environment(), 'imet')
            || ImetEnv::isImetOfflineEnv();
    }

    /**
     * Check if the current environment is the IMET Offline Tool
     * (by checking if the nativephp.version config is set)
     */
    public static function isImetOfflineEnv(): bool
    {
        return config('nativephp.version') !== null;
    }

    /**
     * Check if the current environment is the development env of IMET Global
     */
    public static function isImetGlobalDevEnv(): bool
    {
        return App::environment('imetglobal_dev');
    }

}
