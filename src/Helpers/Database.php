<?php

namespace  ImetCore\Helpers;

class Database
{
    // Connections: used as connection + filename for SQLite offline version
    public const COMMON_CONNECTION = 'offline_public';
    public const IMET_CONNECTION = 'offline_imet';
    public const OECM_CONNECTION = 'offline_oecm';

    // Schemas: used as schema for PostGreSQL online version
    public const COMMON_IMET_SCHEMA = 'imet_common';
    public const IMET_SCHEMA = 'imet';
    public const OECM_SCHEMA = 'imet_oecm';

    /**
     * Get connection and table according to the environment (offline or online)
     * Use different databases (SQLITE) for offline version and different schemas for online version (PostGreSQL)
     */
    static public function getTableAndConnection($requested_table, $requested_schema = null): array
    {
        $is_offline = is_offline_environment();
        $connection = config('database.default');

        // Set Schema
        if($is_offline){
            if($requested_schema === static::IMET_SCHEMA){
                $schema = 'imet_';
            } elseif($requested_schema === static::OECM_SCHEMA){
                $schema = 'oecm_';
            } else {
                $schema = 'public_';
            }
        } else {
            $schema = $requested_schema===null
                ? static::COMMON_IMET_SCHEMA . '.'
                : $requested_schema . '.';
        }

        // Set Table
        $table = $schema . $requested_table;

        return [$table, $connection];
    }
}