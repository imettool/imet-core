<?php

namespace  ImetCore\Helpers;

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
            ? (Str::startsWith($table, $schema.'_') ? $table : $schema . '_' . $table)
            : (Str::startsWith($table, $schema.'.') ? $table : $schema . '.' . $table);
    }
}