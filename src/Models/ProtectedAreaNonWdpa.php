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

namespace ImetCore\Models;

use ImetCore\Helpers\Database;
use ModularForms\Models\BaseModel;

/**
 * Class ProtectedAreaNonWdpa
 *
 * @property string $id
 * @property string $wdpa_id
 * @property string $name
 * @property string $country
 * @property string $Type
 * @property string $iucn_category
 * @property string $creation_date
 */
class ProtectedAreaNonWdpa extends BaseModel
{
    protected static ?string $schema = Database::COMMON_SCHEMA;

    protected $table = 'protected_areas_non_wdpa';

    public const LABEL = 'name';

    private const int START_FAKE_ID = 999990000;

    protected $guarded = [];

    protected $appends = ['wdpa_id'];

    /**
     * Override: get the table name with schema
     */
    #[\Override]
    public function getTable(): string
    {
        return Database::getTable(static::$schema, parent::getTable());
    }

    /**
     * Append "wdpa_id" as id alias
     */
    public function getWdpaIdAttribute(): string
    {
        return $this->id;
    }

    /**
     * Generate a fake wdpa id
     *
     * @return int|mixed|string
     */
    public static function generate_fake_wdpa(?int $max_id = null): int
    {
        $max_id ??= ProtectedAreaNonWdpa::query()->max('id');

        return $max_id === null || ! static::isNonWdpa($max_id)
            ? static::START_FAKE_ID
            : intval($max_id) + 1;
    }

    /**
     * Check if the given id is a fake WDPA or not
     */
    public static function isNonWdpa($wdpa_id): bool
    {
        return $wdpa_id >= ProtectedAreaNonWdpa::START_FAKE_ID;
    }

    /**
     * Export to JSON
     */
    public static function export($id): array
    {
        $pa = static::query()->findOrNew($id);
        $pa->id ??= $id;

        return $pa
            ->makeHidden([static::UPDATED_AT, static::UPDATED_BY])
            ->toArray();
    }

    /**
     * Import from JSON
     *
     * @return mixed
     */
    public static function import(array $data)
    {
        unset($data['wdpa_id']);
        unset($data['id']);

        $pa = ProtectedAreaNonWdpa::query()->firstOrNew($data);
        if ($pa->isDirty()) {
            $pa->id = ProtectedAreaNonWdpa::generate_fake_wdpa();
            $pa->save();
        }

        return $pa->id;
    }
}
