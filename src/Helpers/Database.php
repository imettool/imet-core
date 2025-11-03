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

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Database
{
    const DRIVER_SQLITE = 'sqlite';

    // Schemas: used as schema for PostGreSQL and as prefix for SQLite
    public const COMMON_SCHEMA = 'imet_common';

    public const IMET_SCHEMA = 'imet_v1v2';

    public const OECM_SCHEMA = 'imet_oecm';

    /**
     * Get the table name according to the database driver
     */
    public static function getTable(string $schema, string $table): string
    {
        return DB::getDriverName() === self::DRIVER_SQLITE
            ? (Str::startsWith($table, $schema.'_') ? $table : $schema.'_'.$table)
            : (Str::startsWith($table, $schema.'.') ? $table : $schema.'.'.$table);
    }
}
