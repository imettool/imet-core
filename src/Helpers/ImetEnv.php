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

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ImetEnv
{
    /**
     * Check if the current environment is IMET related (ex. Imet Offline Tool or IMET Global)
     */
    public static function isImetEnv(): bool
    {
        if (Str::contains(App::environment(), 'imet')) {
            return true;
        }

        return ImetEnv::isImetOfflineEnv();
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

    /**
     * Check if the current environment is a development environment
     */
    public static function isDevEnv(): bool
    {
        $env = Str::lower(App::environment());
        if (Str::contains($env, 'dev')) {
            return true;
        }

        if (Str::contains($env, 'local')) {
            return true;
        }

        return static::isImetGlobalDevEnv();
    }

    /**
     * Check if there is an active internet connection
     *
     * @throws ConnectionException
     */
    public static function isConnectionAvailable(): bool
    {
        return Http::get('https://www.github.com')->successful();
    }
}
